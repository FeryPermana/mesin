<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JamKerja;
use Illuminate\Http\Request;

class JamKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list jaker
        $jamkerja = JamKerja::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.jamkerja.index', compact('jamkerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('jamkerja.store');
        return view('pages.dashboard.jamkerja._form', compact('method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:jam_kerja,name',
        ]);

        $jaker = new JamKerja();
        $jaker->name = $request->name;

        $jaker->save();

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
        $url = route('jamkerja.update', $id);
        $jaker = JamKerja::findOrFail($id);
        return view('pages.dashboard.jamkerja._form', compact('method', 'url', 'jaker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:jam_kerja,name,' . $id,
        ]);

        $jaker = JamKerja::findOrFail($id);
        $jaker->name = $request->name;

        $jaker->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $jaker = JamKerja::findOrFail($id);

            $jaker->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete jaker success',
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
