<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Downtime;
use Illuminate\Http\Request;

class DowntimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list shift
        $downtime = Downtime::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.downtime.index', compact('downtime'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('downtime.store');
        return view('pages.dashboard.downtime._form', compact('method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:downtime,name',
        ]);

        $downtime = new Downtime();
        $downtime->name = $request->name;

        $downtime->save();

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
        $url = route('downtime.update', $id);
        $downtime = Downtime::findOrFail($id);
        return view('pages.dashboard.downtime._form', compact('method', 'url', 'downtime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:downtime,name,' . $id,
        ]);

        $downtime = Downtime::findOrFail($id);
        $downtime->name = $request->name;

        $downtime->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $downtime = Downtime::findOrFail($id);

            $downtime->delete();
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
