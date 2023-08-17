<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JenisKegiatan;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\Pengerjaan;
use App\Models\Perawatan;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Exports\HarianExport;
use Maatwebsite\Excel\Facades\Excel;

class MaintenanceHarianController extends Controller
{
    public function index()
    {
        $maintenance = Pengerjaan::join('mesin', 'pengerjaan.mesin_id', '=', 'mesin.id')
            ->select('pengerjaan.*', 'mesin.name as mesin_name')
            ->filter(request())
            ->get()
            ->groupBy('mesin_name');
        $data = [
            'maintenance' => $maintenance,
            'mesin' => Mesin::all(),
            'shift' => Shift::all(),
            'lineproduksi' => LineProduksi::all(),
        ];

        return view('pages.dashboard.maintenance-harian.index', $data);
    }

    public function show($mesin_id)
    {
        $mesin = Mesin::findOrFail($mesin_id);
        $lineproduksi = LineProduksi::all();
        $shift = Shift::all();
        $jeniskegiatan = JenisKegiatan::all();

        $shiftname = "";
        if (@$_GET['shift']) {
            $shiftname = Shift::whereId($_GET['shift'])->first()->name;
        }

        $lineproduksiname = "";
        if (@$_GET['lineproduksi']) {
            $lineproduksiname = LineProduksi::whereId($_GET['lineproduksi'])->first()->name;
        }

        $pengerjaan = Pengerjaan::with('checklist')->where('mesin_id', $mesin_id)->filter(request())->get();

        $data = [
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jeniskegiatan' => $jeniskegiatan,
            'pengerjaan' => $pengerjaan,
            'mesin' => $mesin,
        ];

        if (@$_GET['harian']) {
            toastr()->success('Berhasil export');
            return Excel::download(new HarianExport($pengerjaan), 'export maintenance harian ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . ' .xlsx');
        }

        return view('pages.dashboard.maintenance-harian.show', $data);
    }
}
