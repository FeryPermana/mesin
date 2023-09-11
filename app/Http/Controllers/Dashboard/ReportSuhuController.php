<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\MonitoringSuhu;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ReportSuhuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoringsuhu = MonitoringSuhu::filter(request())->paginate(10);
        $operators = User::whereRole('5')->get();
        $lineproduksi = LineProduksi::all();
        $shift = Shift::all();

        if (@$_GET['print']) {
            toastr()->success('Ctrl + Shift + p untuk print');

            return view('pages.dashboard.report-suhu.preview', [
                'monitoringsuhu' => $monitoringsuhu,
                'operators' => $operators,
            ]);
        }

        return view('pages.dashboard.report-suhu.index', compact('monitoringsuhu', 'operators', 'lineproduksi', 'shift'));
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
