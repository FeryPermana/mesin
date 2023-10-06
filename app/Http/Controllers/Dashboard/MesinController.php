<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HasLine;
use App\Models\JenisKegiatan;
use App\Models\JenisKegiatanMesin;
use App\Models\LineProduksi;
use App\Models\Lokasi;
use App\Models\Mesin;
use App\Models\TutorialMesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list mesin
        $lokasi = Lokasi::all();
        $mesin = Mesin::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.mesin.index', compact('mesin', 'lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('mesin.store');
        $lokasi = Lokasi::all();
        $bulan = bulan_list();
        $lineproduksi = LineProduksi::all();

        $jeniskegiatan = JenisKegiatan::all();

        return view('pages.dashboard.mesin._form', compact('method', 'url', 'lokasi', 'jeniskegiatan', 'bulan', 'lineproduksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:mesin,name',
            'merk' => 'required',
            'kapasitas' => 'required',
            'lokasi' => 'required',
            'tahun_pembuatan' => 'required',
            'periode_pakai' => 'required',
            'lineproduksi' => 'required',
        ]);

        $d = Mesin::count();

        $mesin = Mesin::create([
            'code' => 'MC00' . ($d + 1),
            'name' => $request->name,
            'merk' => $request->merk,
            'kapasitas' => $request->kapasitas,
            'lokasi_id' => $request->lokasi,
            'tahun_pembuatan' => $request->tahun_pembuatan,
            'periode_pakai' => $request->periode_pakai,
        ]);

        $data = Mesin::where('name', $request->name)->first();

        foreach ($request->lineproduksi as $lp) {
            if (HasLine::where('mesin_id', $mesin->id)->where('lineproduksi_id', $lp)->first()) {
                return redirect()->back()->with('error', 'Mesin dengan line ini sudah ada')->withInput();
            } else {
                HasLine::create([
                    'lineproduksi_id' => $lp,
                    'mesin_id' => $data->id,
                ]);
            }
        }


        // if (JenisKegiatanMesin::where('mesin_id', $mesin->id)->where('bulan', $request->bulan)->where('tahun', date('Y'))->first()) {
        //     return redirect()->back()->with('error', 'Data dengan bulan ini sudah ada')->withInput();
        // } else {
        //     foreach ($request->jenis_kegiatan as $jk) {
        //         foreach ($request->jenis_kegiatan as $jk) {
        //             JenisKegiatanMesin::create([
        //                 'jenis_kegiatan_id' => $jk,
        //                 'mesin_id' => $mesin->id,
        //                 'bulan' => $request->bulan,
        //                 'tahun' => date('Y')
        //             ]);
        //         }
        //     }
        // }

        return redirect('dashboard/mesin/' . $mesin->id . '/edit?type=harian')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $method = "update";
        $url = route('mesin.update', $id);
        $mesin = Mesin::findOrFail($id);
        $lokasi = Lokasi::all();
        $jeniskegiatan = JenisKegiatan::all();
        $bulan = bulan_list();
        $lineproduksi = LineProduksi::all();

        return view('pages.dashboard.mesin._form', compact('method', 'url', 'mesin', 'lokasi', 'jeniskegiatan', 'bulan', 'lineproduksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:mesin,name,' . $id,
            'merk' => 'required',
            'kapasitas' => 'required',
            'lokasi' => 'required',
            'tahun_pembuatan' => 'required',
            'periode_pakai' => 'required',
            'jenis_kegiatan' => 'required',
            'lineproduksi' => 'required',
        ]);

        $mesin = Mesin::findOrFail($id);
        $mesin->name = $request->name;
        $mesin->merk = $request->merk;
        $mesin->kapasitas = $request->kapasitas;
        $mesin->lokasi_id = $request->lokasi;
        $mesin->tahun_pembuatan = $request->tahun_pembuatan;
        $mesin->periode_pakai = $request->periode_pakai;

        HasLine::where('mesin_id', $mesin->id)->delete();

        foreach ($request->lineproduksi as $lp) {
            HasLine::create([
                'lineproduksi_id' => $lp,
                'mesin_id' => $mesin->id,
            ]);
        }

        JenisKegiatanMesin::where('mesin_id', $mesin->id)->where('bulan', $request->bulan)->where('type', $request->type)->where('tahun', date('Y'))->delete();
        foreach ($request->jenis_kegiatan as $jk) {
            JenisKegiatanMesin::create([
                'jenis_kegiatan_id' => $jk,
                'mesin_id' => $mesin->id,
                'type' => $request->type,
                'bulan' => $request->bulan,
                'tahun' => date('Y')
            ]);
        }

        $mesin->save();


        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mesin = Mesin::findOrFail($id);

            $mesin->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete mesin success',
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error',
            ]);

            return back()->withInput();
        }
    }

    public function file(string $id)
    {
        $method = "update";
        if (@$_GET['line']) {
            $url = route('mesin.lessonupdate', $id);
        } else {
            $url = route('mesin.lesson', $id);
        }
        $mesin = Mesin::findOrFail($id);
        $tutorialmesin = TutorialMesin::where('id', @$_GET['tutorialmesin'])->first();
        $tutorialmesins = TutorialMesin::where('mesin_id', $mesin->id)->where('lineproduksi_id', @$_GET['lineproduksi'])->get();
        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', $mesin->id)
            ->get();

        return view('pages.dashboard.mesin.lesson', compact('method', 'url', 'mesin', 'lineproduksi', 'tutorialmesin', 'tutorialmesins'));
    }

    public function lesson(Request $request, string $id)
    {
        // return $request->all();
        $request->validate([
            'title' => 'required',
            'lineproduksi_id' => 'required',
            'deskripsi' => 'required',
            'video' => 'required',
            'file' => 'required|mimes:pdf',
        ]);

        $file = "";
        if ($request->hasFile('file')) {
            $image = $request->file;
            $file = time() . $image->getClientOriginalName();
            $image->move('file', $file);

            $file = "file/" . $file;
        }

        $mesin = TutorialMesin::create([
            'title' => $request->title,
            'mesin_id' => $id,
            'lineproduksi_id' => $request->lineproduksi_id,
            'deskripsi' => $request->deskripsi,
            'video' => $request->video,
            'file' => $file,
        ]);

        return redirect('/dashboard/mesin/' . $id . '/file?lineproduksi=' . $mesin->lineproduksi_id)->with('success', 'Berhasil mengupload tutorial');
    }

    public function lessonupdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'lineproduksi_id' => 'required',
            'deskripsi' => 'required',
            'video' => 'required',
            'file' => 'required|mimes:pdf',
        ]);

        $file = "";
        if ($request->hasFile('file')) {
            $image = $request->file;
            $file = time() . $image->getClientOriginalName();
            $image->move('file', $file);

            $file = "file/" . $file;
        }

        $mesin = TutorialMesin::where('id', $request->tutorialmesin_id)->update([
            'title' => $request->title,
            'mesin_id' => $id,
            'lineproduksi_id' => $request->lineproduksi_id,
            'deskripsi' => $request->deskripsi,
            'video' => $request->video,
            'file' => $file,
        ]);

        return redirect('/dashboard/mesin/' . $id . '/file?lineproduksi=' . $request->lineproduksi_id)->with('success', 'Berhasil mengubah tutorial');
    }

    public function lessondelete($id)
    {
        try {
            $tutorialmesin = TutorialMesin::findOrFail($id);

            $tutorialmesin->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete tutorial success',
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error',
            ]);

            return back()->withInput();
        }
    }
}
