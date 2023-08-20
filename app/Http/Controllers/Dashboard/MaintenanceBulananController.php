<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JenisKegiatan;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\PengerjaanBulanan;
use App\Models\PengerjaanMingguan;
use App\Models\Shift;
use Illuminate\Http\Request;

class MaintenanceBulananController extends Controller
{
    public function index()
    {
        $maintenance = PengerjaanBulanan::join('mesin', 'pengerjaan_bulanan.mesin_id', '=', 'mesin.id')
            ->select('pengerjaan_bulanan.*', 'mesin.name as mesin_name')
            ->filter(request())
            ->get()
            ->groupBy('mesin_name');
        $data = [
            'maintenance' => $maintenance,
            'mesin' => Mesin::all(),
            'shift' => Shift::all(),
            'lineproduksi' => LineProduksi::all(),
        ];

        return view('pages.dashboard.maintenance-bulanan.index', $data);
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

        $pengerjaan = PengerjaanBulanan::with('checklistbulanan')->where('mesin_id', $mesin_id)->filter(request())->get();

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
            return view('pages.dashboard.maintenance-bulanan.preview', [
                'lineproduksiname' => $lineproduksiname,
                'shiftname' => $shiftname,
                'jeniskegiatan' => $jeniskegiatan,
                'pengerjaan' => $pengerjaan,
                'mesin' => $mesin,
            ]);
        }

        if (@$_GET['image']) {
            return view('pages.dashboard.maintenance-bulanan.image', [
                'lineproduksiname' => $lineproduksiname,
                'shiftname' => $shiftname,
                'lineproduksi' => $lineproduksi,
                'shift' => $shift,
                'jeniskegiatan' => $jeniskegiatan,
                'pengerjaan' => $pengerjaan,
                'mesin' => $mesin,
            ]);
        }

        return view('pages.dashboard.maintenance-bulanan.show', $data);
    }
}