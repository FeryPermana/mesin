<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JenisKegiatan;
use App\Models\JenisKegiatanMesin;
use App\Models\Lokasi;
use App\Models\Mesin;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list mesin
        $mesin = Mesin::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.mesin.index', compact('mesin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('mesin.store');
        $lokasi = Lokasi::all();
        $jeniskegiatan = JenisKegiatan::all();
        return view('pages.dashboard.mesin._form', compact('method', 'url', 'lokasi', 'jeniskegiatan'));
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
            'periode_pakai' => 'required'
        ]);

        $d = Mesin::count();

        $mesin = new Mesin();
        $mesin->code = 'MC00' . ($d + 1);
        $mesin->name = $request->name;
        $mesin->merk = $request->merk;
        $mesin->kapasitas = $request->kapasitas;
        $mesin->lokasi_id = $request->lokasi;
        $mesin->tahun_pembuatan = $request->tahun_pembuatan;
        $mesin->periode_pakai = $request->periode_pakai;

        $mesin->save();

        foreach ($request->jenis_kegiatan as $jk) {
            JenisKegiatanMesin::create([
                'jenis_kegiatan_id' => $jk,
                'mesin_id' => $mesin->id,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
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

        return view('pages.dashboard.mesin._form', compact('method', 'url', 'mesin', 'lokasi', 'jeniskegiatan'));
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
            'jenis_kegiatan' => 'required'
        ]);

        $mesin = Mesin::findOrFail($id);
        $mesin->name = $request->name;
        $mesin->merk = $request->merk;
        $mesin->kapasitas = $request->kapasitas;
        $mesin->lokasi_id = $request->lokasi;
        $mesin->tahun_pembuatan = $request->tahun_pembuatan;
        $mesin->periode_pakai = $request->periode_pakai;

        $mesin->save();

        JenisKegiatanMesin::where('mesin_id', $mesin->id)->delete();
        foreach ($request->jenis_kegiatan as $jk) {
            JenisKegiatanMesin::create([
                'jenis_kegiatan_id' => $jk,
                'mesin_id' => $mesin->id,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diubah');
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
}
