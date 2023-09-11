<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\MonitoringSuhu;
use App\Models\Shift;
use Illuminate\Http\Request;

class MonitoringSuhuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoringsuhu = MonitoringSuhu::where('operator_id', auth()->user()->id)->get();

        $lineproduksi = LineProduksi::all();
        $shift = Shift::all();

        return view('pages.dashboard.suhu.index', compact('monitoringsuhu', 'lineproduksi', 'shift'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'suhu' => 'required',
            'rh' => 'required',
            'keterangan' => 'required',
            'lineproduksi' => 'required',
            'shift_id'
        ]);

        $data = $request->all();
        $data['operator_id'] = auth()->user()->id;
        $data['lineproduksi_id'] = $request->lineproduksi;
        $data['shift_id'] = $request->shift;


        MonitoringSuhu::create($data);
        return redirect()->back()->with('success', 'Berhasil !!!');
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
