<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JenisKegiatan;
use Illuminate\Http\Request;

class JenisKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list shift
        $jeniskegiatan = JenisKegiatan::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.jenis-kegiatan.index', compact('jeniskegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('jenis-kegiatan.store');
        return view('pages.dashboard.jenis-kegiatan._form', compact('method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:jenis_kegiatan,name',
            'standart' => 'required'
        ]);

        $jeniskegiatan = new JenisKegiatan();
        $jeniskegiatan->name = $request->name;
        $jeniskegiatan->standart = $request->standart;

        $jeniskegiatan->save();

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
        $url = route('jenis-kegiatan.update', $id);
        $jeniskegiatan = JenisKegiatan::findOrFail($id);
        return view('pages.dashboard.jenis-kegiatan._form', compact('method', 'url', 'jeniskegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:jenis_kegiatan,name,' . $id,
            'standart' => 'required'
        ]);

        $jeniskegiatan = JenisKegiatan::findOrFail($id);
        $jeniskegiatan->name = $request->name;
        $jeniskegiatan->standart = $request->standart;

        $jeniskegiatan->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $jeniskegiatan = JenisKegiatan::findOrFail($id);

            $jeniskegiatan->delete();
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
