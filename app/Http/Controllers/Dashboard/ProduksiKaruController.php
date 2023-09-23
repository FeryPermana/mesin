<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JamKerja;
use App\Models\LineProduksi;
use App\Models\Lokasi;
use App\Models\Mesin;
use App\Models\Produksi;
use App\Models\Reject;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduksiKaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produksis = Produksi::filter(request())->get();

        $tanggal = Produksi::select('tanggal')->groupBy('tanggal')->get();

        $shifts = Shift::all();

        $lineproduksis = LineProduksi::all();


        $data = [
            'produksis' => $produksis,
            'tanggal' => $tanggal,
            'shifts' => $shifts,
            'lineproduksis' => $lineproduksis
        ];

        return view('pages.dashboard.produksi-karu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mesin = Mesin::all();

        if (@$_GET['mesinkey']) {
            $lineproduksi = DB::table('lineproduksi')
                ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
                ->select('lineproduksi.*', 'lineproduksi.name')
                ->where('hasline.mesin_id', @$_GET['mesinkey'])
                ->get();
        } else {
            $lineproduksi = LineProduksi::all();
        }

        if (@$_GET['shiftkey']) {
            $jamkerja = JamKerja::where('shift_id', @$_GET['shiftkey'])->get();
        } else {
            $jamkerja = JamKerja::all();
        }

        $shift = Shift::all();
        $lokasi = Lokasi::all();

        $data = [
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'lokasi' => $lokasi,
            'jamkerja' => $jamkerja,
            'url' => route('produksi-karu.store'),
            'method' => 'store'
        ];

        return view('pages.dashboard.produksi-karu.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shift' => 'required',
            'lineproduksi' => 'required',
            'tanggal' => 'required',
        ]);

        $arraypallet = $request->pallet;
        $arrayketerangan = $request->keterangan;
        $jamkerja = JamKerja::where('shift_id', $request->shift)->get();
        foreach ($jamkerja as $key => $value) {
            $produksi = new Produksi();
            $produksi->shift_id = $request->shift;
            $produksi->lineproduksi_id = $request->lineproduksi;
            $produksi->tanggal = $request->tanggal;
            $produksi->pallet = $arraypallet[$key];
            $produksi->keterangan = $arrayketerangan[$key];
            $produksi->jam_kerja_id = $value->id;
            $produksi->save();
        }

        return redirect()->back()->with('success', 'Berhasil');
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
    public function edit($shift_id, $lineproduksi_id)
    {
        $produksi = Produksi::where('shift_id', $shift_id)->where('lineproduksi_id', $lineproduksi_id)->get();
        $mesin = Mesin::all();

        if (@$_GET['mesinkey']) {
            $lineproduksi = DB::table('lineproduksi')
                ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
                ->select('lineproduksi.*', 'lineproduksi.name')
                ->where('hasline.mesin_id', @$_GET['mesinkey'])
                ->get();
        } else {
            $lineproduksi = LineProduksi::all();
        }

        if (@$_GET['shiftkey']) {
            $jamkerja = JamKerja::where('shift_id', @$_GET['shiftkey'])->get();
        } else {
            $jamkerja = JamKerja::where('shift_id', $produksi[0]->shift_id)->get();
        }

        $shift = Shift::all();
        $lokasi = Lokasi::all();

        $data = [
            'produksi' => $produksi,
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'lokasi' => $lokasi,
            'jamkerja' => $jamkerja,
            'url' => route('produksi-karu.update', ['shift_id' => $produksi[0]->shift_id, 'lineproduksi_id' => $produksi[0]->lineproduksi_id]),
            'method' => 'update'
        ];

        return view('pages.dashboard.produksi-karu.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $shift_id, $lineproduksi_id)
    {
        $request->validate([
            'lineproduksi' => 'required',
            'tanggal' => 'required',
        ]);

        $arraypallet = $request->pallet;
        $arrayketerangan = $request->keterangan;
        $jamkerja = JamKerja::where('shift_id', $request->shift)->get();
        $prod = Produksi::where('shift_id', $shift_id)->where('lineproduksi_id', $lineproduksi_id)->get();

        foreach ($jamkerja as $key => $value) {
            $produksi = $prod[$key];
            $produksi->shift_id = $request->shift;
            $produksi->lineproduksi_id = $request->lineproduksi;
            $produksi->tanggal = $request->tanggal;
            $produksi->pallet = $arraypallet[$key];
            $produksi->keterangan = $arrayketerangan[$key];
            $produksi->jam_kerja_id = $value->id;
            $produksi->save();
        }

        return redirect('dashboard/produksi-karu/' . $request->shift . '/' . $request->lineproduksi . '?shiftkey=' . $request->shift)->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
