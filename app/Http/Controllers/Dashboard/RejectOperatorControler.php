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

        $lineproduksis = LineProduksi::all();

        $data = [
            'rejects' => $rejects,
            'tanggal' => $tanggal,
            'shifts' => $shifts,
            'lineproduksis' => $lineproduksis
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
            'url' => route('reject-operator.store'),
            'method' => 'store'
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

        $jamkerja = JamKerja::where('shift_id', $request->shift)->get();
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
    public function edit($mesin_id, $shift_id, $lineproduksi_id)
    {
        $reject = Reject::where('mesin_id', $mesin_id)->where('shift_id', $shift_id)->where('lineproduksi_id', $lineproduksi_id)->get();
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
            $jamkerja = JamKerja::where('shift_id', $reject[0]->shift_id)->get();
        }

        $shift = Shift::all();
        $lokasi = Lokasi::all();

        $data = [
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'lokasi' => $lokasi,
            'jamkerja' => $jamkerja,
            'reject' => $reject,
            'url' => route('reject-operator.update', ['mesin_id' => $reject[0]->mesin_id, 'shift_id' => $reject[0]->shift_id, 'lineproduksi_id' => $reject[0]->lineproduksi_id]),
            'method' => 'update'
        ];

        return view('pages.dashboard.reject-operator.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $mesin_id, $shift_id, $lineproduksi_id)
    {
        $request->validate([
            'lineproduksi' => 'required',
            'tanggal' => 'required',
        ]);

        $arrayrejectbotol = $request->reject_botol;
        $arrayrejecttutup = $request->reject_tutup;
        $arrayrejectproduksi = $request->reject_produksi;
        $arrayketerangan = $request->keterangan;

        $jamkerja = JamKerja::where('shift_id', $request->shift)->get();
        $rej = Reject::where('mesin_id', $mesin_id)->where('shift_id', $shift_id)->where('lineproduksi_id', $lineproduksi_id)->get();
        foreach ($jamkerja as $key => $value) {
            $reject = $rej[$key];
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

        return redirect('dashboard/reject-operator/' . $request->mesin . '/' . $request->shift . '/' . $request->lineproduksi . '?mesinkey=' . $request->mesin . '&shiftkey=' . $request->shift)->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
