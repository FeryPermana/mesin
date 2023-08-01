<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list mesin
        $mesin = Mesin::filter(request())->paginate($_GET['row'] ?? 1);

        return view('pages.dashboard.mesin.index', compact('mesin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('mesin.store');
        return view('pages.dashboard.mesin.create', compact('method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:mesin,name',
            'merk' => 'required',
            'kapasitas' => 'required'
        ]);

        $d = Mesin::count();

        $mesin = new Mesin();
        $mesin->code = 'MC00' . ($d + 1);
        $mesin->name = $request->name;
        $mesin->merk = $request->merk;
        $mesin->kapasitas = $request->kapasitas;

        $mesin->save();

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
        $url = route('mesin.update', $id);
        $mesin = Mesin::findOrFail($id);
        return view('pages.dashboard.mesin.create', compact('method', 'url', 'mesin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:mesin,name,' . $id,
            'merk' => 'required',
            'kapasitas' => 'required'
        ]);

        $mesin = Mesin::findOrFail($id);
        $mesin->name = $request->name;
        $mesin->merk = $request->merk;
        $mesin->kapasitas = $request->kapasitas;

        $mesin->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mesin = Mesin::findOrFail($id);

            $mesin->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete mesin success',
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
