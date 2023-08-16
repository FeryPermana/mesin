<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list shift
        $shift = Shift::filter(request())->paginate($_GET['row'] ?? 10);

        return view('pages.dashboard.shift.index', compact('shift'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $method = "store";
        $url = route('shift.store');
        return view('pages.dashboard.shift._form', compact('method', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:shift,name',
        ]);

        $shift = new Shift();
        $shift->name = $request->name;

        $shift->save();

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
        $url = route('shift.update', $id);
        $shift = Shift::findOrFail($id);
        return view('pages.dashboard.shift._form', compact('method', 'url', 'shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:shift,name,' . $id,
        ]);

        $shift = Shift::findOrFail($id);
        $shift->name = $request->name;

        $shift->save();

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $shift = Shift::findOrFail($id);

            $shift->delete();
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
