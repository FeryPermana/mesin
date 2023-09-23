<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\Shift;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeknisiSparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sparepart = Sparepart::filter(request())->paginate(@$_GET['row'] ?? 10);

        return view('pages.dashboard.teknisi-sparepart.index', compact('sparepart'));
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
        //
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
        $url = route('teknisi-sparepart.update', $id);
        $sparepart = Sparepart::find($id);
        $mesin = Mesin::all();
        $mesinkey = @$_GET['mesinkey'] ?? $sparepart->mesin_id;
        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', $mesinkey)
            ->get();
        $shift = Shift::all();

        return view('pages.dashboard.teknisi-sparepart._form', compact('method', 'url', 'sparepart', 'lineproduksi', 'shift', 'mesin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'item' => 'required',
            'mesin' => 'required',
            'kode_barang' => 'required',
            'stock' => 'required',
            'tanggal_keluar' => 'required',
            'lineproduksi' => 'required',
            'shift' => 'required',
            'keterangan' => 'required'
        ]);

        $sparepart = Sparepart::find($id);
        $sparepart->item = $request->item;
        $sparepart->mesin_id = $request->mesin;
        $sparepart->jumlah = $request->jumlah;
        $sparepart->tanggal_keluar = $request->tanggal_keluar;
        $sparepart->stock = $request->stock;
        $sparepart->kode_barang = $request->kode_barang;
        $sparepart->lineproduksi_id = $request->lineproduksi;
        $sparepart->shift_id = $request->shift;
        $sparepart->keterangan = $request->keterangan;
        $sparepart->user_id = auth()->user()->id;
        $sparepart->save();

        return redirect()->route('teknisi-sparepart.index')->with('success', 'Berhasil merubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
