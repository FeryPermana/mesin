<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JenisKegiatan;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\PengerjaanMingguan;
use App\Models\Shift;
use Illuminate\Http\Request;

class MaintenanceBulananController extends Controller
{
    public function index()
    {
        $maintenance = PengerjaanMingguan::join('mesin', 'pengerjaan_mingguan.mesin_id', '=', 'mesin.id')
            ->select('pengerjaan_mingguan.*', 'mesin.name as mesin_name')
            ->filter(request())
            ->get()
            ->groupBy('mesin_name');
        $data = [
            'maintenance' => $maintenance,
            'mesin' => Mesin::all(),
            'shift' => Shift::all(),
            'lineproduksi' => LineProduksi::all(),
        ];

        return view('pages.dashboard.maintenance-mingguan.index', $data);
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

        $pengerjaan = PengerjaanMingguan::with('checklistmingguan')->where('mesin_id', $mesin_id)->filter(request())->get();

        $data = [
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jeniskegiatan' => $jeniskegiatan,
            'pengerjaan' => $pengerjaan,
            'mesin' => $mesin,
        ];

        // if (@$_GET['harian']) {
        //     toastr()->success('Berhasil export');
        //     // $pdf = PDF::loadView('exports.harian', [
        //     //     'mesin' => $mesin,
        //     //     'jeniskegiatan' => $jeniskegiatan,
        //     //     'pengerjaan' => $pengerjaan
        //     // ])->setPaper('landscape');

        //     // return $pdf->download('export maintenance harian ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . '.pdf');
        //     return Excel::download(new HarianExport($pengerjaan), 'export maintenance harian ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . ' .xlsx');
        // }

        if (@$_GET['print']) {
            return view('pages.dashboard.maintenance-mingguan.preview', [
                'lineproduksiname' => $lineproduksiname,
                'shiftname' => $shiftname,
                'jeniskegiatan' => $jeniskegiatan,
                'pengerjaan' => $pengerjaan,
                'mesin' => $mesin,
            ]);
        }

        return view('pages.dashboard.maintenance-mingguan.show', $data);
    }
}
