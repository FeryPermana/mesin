<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\Produksi;
use App\Models\Reject;
use App\Models\Shift;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rejects = Reject::filter(request())->get();

        $tanggal = Reject::select('tanggal')->groupBy('tanggal')->get();

        $shifts = Shift::all();

        $lineproduksis = LineProduksi::all();

        $data = [
            'rejects' => $rejects,
            'tanggal' => $tanggal,
            'shifts' => $shifts,
            'lineproduksis' => $lineproduksis
        ];

        return view('pages.dashboard.reject.index', $data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
