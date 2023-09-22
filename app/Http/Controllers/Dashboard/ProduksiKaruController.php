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


        $data = [
            'produksis' => $produksis,
            'tanggal' => $tanggal,
            'shifts' => $shifts
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
            'jamkerja' => $jamkerja
        ];

        return view('pages.dashboard.produksi-karu.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mesin' => 'required',
            'shift' => 'required',
            'lineproduksi' => 'required',
            'tanggal' => 'required',
        ]);

        $arraypallet = $request->pallet;
        $arrayketerangan = $request->keterangan;
        $jamkerja = JamKerja::where('shift_id', $request->shift)->get();
        foreach ($jamkerja as $key => $value) {
            $produksi = new Produksi();
            $produksi->mesin_id = $request->mesin;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
