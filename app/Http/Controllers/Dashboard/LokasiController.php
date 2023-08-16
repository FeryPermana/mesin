<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list shift
        $lokasi = Lokasi::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.lokasi.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('lokasi.store');
        return view('pages.dashboard.lokasi._form', compact('method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|unique:lokasi,lokasi',
        ]);

        $d = Lokasi::count();

        $lokasi = new Lokasi();
        $lokasi->kode = 'L' . ($d + 1);
        $lokasi->lokasi = $request->lokasi;

        $lokasi->save();

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
        $url = route('lokasi.update', $id);
        $lokasi = Lokasi::findOrFail($id);
        return view('pages.dashboard.lokasi._form', compact('method', 'url', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lokasi' => 'required|unique:lokasi,lokasi,' . $id,
        ]);

        $d = Lokasi::count();

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->lokasi = $request->lokasi;

        $lokasi->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lokasi = Lokasi::findOrFail($id);

            $lokasi->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete lokasi success',
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
