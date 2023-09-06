<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\Lokasi;
use App\Models\Mesin;
use App\Models\Perbaikan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerbaikanTeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mesin = Mesin::all();

        if (@$_GET['mesin']) {
            $lineproduksis = DB::table('lineproduksi')
                ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
                ->select('lineproduksi.*', 'lineproduksi.name')
                ->where('hasline.mesin_id', @$_GET['mesin'])
                ->get();
        } else {
            $lineproduksis = LineProduksi::all();
        }

        $shift = Shift::all();
        $lokasi = Lokasi::all();

        $perbaikan = Perbaikan::whereHas('mesin', function ($query) {
            $query->whereHas('lokasi', function ($q) {
                $q->where('lokasi_id', auth()->user()->lokasi_id);
            });
        })->filter(request())->get();

        $data = [
            'mesin' => $mesin,
            'lineproduksis' => $lineproduksis,
            'shift' => $shift,
            'lokasi' => $lokasi,
            'perbaikan' => $perbaikan,
        ];
        return view('pages.dashboard.teknisi-perbaikan.index', $data);
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
        $shift = Shift::all();
        $perbaikan = Perbaikan::findOrFail($id);
        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', $perbaikan->mesin_id)
            ->get();

        return view('pages.dashboard.teknisi-perbaikan._form', compact('perbaikan', 'shift', 'lineproduksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'action' => 'required',
            'pergantian_spare' => 'required',
        ]);

        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->action = $request->action;
        $perbaikan->pergantian_spare = $request->pergantian_spare;
        $perbaikan->teknisi_id = auth()->user()->id;
        $gambar = $perbaikan->gambar;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $gambar = time() . $image->getClientOriginalName();
            $image->move('upload/perbaikan', $gambar);

            $gambar = "upload/perbaikan/" . $gambar;
        }

        $perbaikan->gambar = $gambar;
        $perbaikan->save();

        return redirect()->back()->with('success', 'Berhasil mengubah !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
