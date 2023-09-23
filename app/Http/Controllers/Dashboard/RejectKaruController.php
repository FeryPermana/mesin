<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JamKerja;
use App\Models\LineProduksi;
use App\Models\Lokasi;
use App\Models\Mesin;
use App\Models\Reject;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RejectKaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rejects = Reject::all();

        $data = [
            'rejects' => $rejects
        ];

        return view('pages.dashboard.reject-karu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mesin = Mesin::all();

        $lineproduksi = LineProduksi::all();

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

        return view('pages.dashboard.reject-karu.create', $data);
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
        $jamkerja = JamKerja::all();
        foreach ($jamkerja as $key => $value) {
            $reject = new Reject();
            $reject->shift_id = $request->shift;
            $reject->lineproduksi_id = $request->lineproduksi;
            $reject->tanggal = $request->tanggal;
            $reject->pallet = $arraypallet[$key];
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
