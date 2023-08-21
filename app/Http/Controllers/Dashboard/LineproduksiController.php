<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use Illuminate\Http\Request;

class LineproduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list shift
        $lineproduksi = LineProduksi::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.line-produksi.index', compact('lineproduksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('line-produksi.store');
        return view('pages.dashboard.line-produksi._form', compact('method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:lineproduksi,name',
        ]);

        $lineproduksi = new LineProduksi();
        $lineproduksi->name = $request->name;

        $lineproduksi->save();

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
        $url = route('line-produksi.update', $id);
        $lineproduksi = LineProduksi::findOrFail($id);
        return view('pages.dashboard.line-produksi._form', compact('method', 'url', 'lineproduksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:lineproduksi,name,' . $id,
        ]);

        $lineproduksi = LineProduksi::findOrFail($id);
        $lineproduksi->name = $request->name;

        $lineproduksi->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lineproduksi = LineProduksi::findOrFail($id);

            $lineproduksi->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete shift success',
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
