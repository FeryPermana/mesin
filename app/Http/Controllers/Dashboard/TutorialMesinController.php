<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use App\Models\TutorialMesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorialMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'mesin' => Mesin::all(),
            'lineproduksi' => DB::table('lineproduksi')
                ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
                ->select('lineproduksi.*', 'lineproduksi.name')
                ->where('hasline.mesin_id', @$_GET['mesinkey'])
                ->get(),
            'tutorialmesin' => TutorialMesin::where('mesin_id', @$_GET['mesinkey'])->where('lineproduksi_id', @$_GET['lineproduksi'])->get(),
            'tutorial' => TutorialMesin::where('title', @$_GET['title'])->first(),
        ];

        return view('pages.dashboard.tutorial-mesin.index', $data);
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
