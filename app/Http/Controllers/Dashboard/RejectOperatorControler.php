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

class RejectOperatorControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rejects = Reject::filter(request())->get();

        $tanggal = Produksi::select('tanggal')->groupBy('tanggal')->get();

        $shifts = Shift::all();

        $data = [
            'rejects' => $rejects,
            'tanggal' => $tanggal,
            'shifts' => $shifts
        ];

        return view('pages.dashboard.reject-operator.index', $data);
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

        $shift = Shift::all();
        $lokasi = Lokasi::all();

        $jamkerja = JamKerja::all();

        $data = [
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'lokasi' => $lokasi,
            'jamkerja' => $jamkerja
        ];

        return view('pages.dashboard.reject-operator.create', $data);
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

        $arrayrejectbotol = $request->reject_botol;
        $arrayrejecttutup = $request->reject_tutup;
        $arrayrejectproduksi = $request->reject_produksi;
        $arrayketerangan = $request->keterangan;

        $jamkerja = JamKerja::all();
        foreach ($jamkerja as $key => $value) {
            $reject = new Reject();
            $reject->mesin_id = $request->mesin;
            $reject->shift_id = $request->shift;
            $reject->lineproduksi_id = $request->lineproduksi;
            $reject->tanggal = $request->tanggal;
            $reject->reject_botol = $arrayrejectbotol[$key];
            $reject->reject_tutup = $arrayrejecttutup[$key];
            $reject->reject_produksi = $arrayrejectproduksi[$key];
            $reject->keterangan = $arrayketerangan[$key];
            $reject->jam_kerja_id = $value->id;
            $reject->save();
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
