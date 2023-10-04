<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use App\Models\Shift;
use App\Models\Sparepart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sparepart = Sparepart::filter(request())->paginate(@$_GET['row'] ?? 10);

        return view('pages.dashboard.sparepart.index', compact('sparepart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('sparepart.store');

        $mesin = Mesin::all();
        $mesinkey = @$_GET['mesinkey'];
        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', $mesinkey)
            ->get();
        $shift = Shift::all();

        return view('pages.dashboard.sparepart._form', compact('method', 'url', 'mesin', 'lineproduksi', 'shift'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'mesin' => 'required',
            'kode_barang' => 'required',
            'stock' => 'required',
            'tanggal_masuk',
            'lineproduksi' => 'required',
            'shift' => 'required',
        ]);

        $sparepart = new Sparepart();
        $sparepart->item = $request->item;
        $sparepart->kode_barang = $request->kode_barang;
        $sparepart->stock = $request->stock;
        $sparepart->tanggal_masuk = $request->tanggal_masuk;
        $sparepart->mesin_id = $request->mesin;
        $sparepart->lineproduksi_id = $request->lineproduksi;
        $sparepart->shift_id = $request->shift;
        $sparepart->save();

        return redirect()->route('sparepart.index')->with('success', 'Berhasil menambahkan');
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
        $url = route('sparepart.update', $id);
        $sparepart = Sparepart::find($id);
        $mesin = Mesin::all();
        $mesinkey = @$_GET['mesinkey'] ?? $sparepart->mesin_id;
        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', $mesinkey)
            ->get();
        $shift = Shift::all();

        return view('pages.dashboard.sparepart._form', compact('method', 'url', 'sparepart', 'mesin', 'lineproduksi', 'shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'item' => 'required',
            'kode_barang' => 'required',
            'stock' => 'required',
            'tanggal_masuk',
            'lineproduksi' => 'required',
            'shift' => 'required',
        ]);

        $sparepart = Sparepart::find($id);
        $sparepart->item = $request->item;
        $sparepart->kode_barang = $request->kode_barang;
        $sparepart->stock = $request->stock;
        $sparepart->tanggal_masuk = $request->tanggal_masuk;
        $sparepart->mesin_id = $request->mesin;
        $sparepart->lineproduksi_id = $request->lineproduksi;
        $sparepart->shift_id = $request->shift;
        $sparepart->save();

        return redirect()->route('sparepart.index')->with('success', 'Berhasil merubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $sparepart = Sparepart::findOrFail($id);

            $sparepart->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete Spare Part success',
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
