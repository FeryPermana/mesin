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
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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
        $jeniskegiatan = DB::table('jenis_kegiatan')
            ->join('jeniskegiatanmesin', 'jenis_kegiatan.id', '=', 'jeniskegiatanmesin.jenis_kegiatan_id')
            ->select('jenis_kegiatan.*', 'jenis_kegiatan.name', 'jenis_kegiatan.standart')
            ->where('jeniskegiatanmesin.mesin_id', $mesin_id)
            ->where('jeniskegiatanmesin.bulan', @$_GET['bulan'] ?? bulanSaatIni())
            ->where('jeniskegiatanmesin.tahun', @$_GET['tahun'] ?? date('Y'))
            ->where('jeniskegiatanmesin.type', 'harian')
            ->get();

        $shiftname = "";
        if (@$_GET['shift']) {
            $shiftname = Shift::whereId($_GET['shift'])->first()->name;
        }

        $lineproduksiname = "";
        if (@$_GET['lineproduksi']) {
            $lineproduksiname = LineProduksi::whereId($_GET['lineproduksi'])->first()->name;
        }

        $bulanMapping = [
            "Januari" => 1,
            "Februari" => 2,
            "Maret" => 3,
            "April" => 4,
            "Mei" => 5,
            "Juni" => 6,
            "Juli" => 7,
            "Agustus" => 8,
            "September" => 9,
            "Oktober" => 10,
            "November" => 11,
            "Desember" => 12
        ];

        $bulanMapping = [
            "Januari" => 1,
            "Februari" => 2,
            "Maret" => 3,
            "April" => 4,
            "Mei" => 5,
            "Juni" => 6,
            "Juli" => 7,
            "Agustus" => 8,
            "September" => 9,
            "Oktober" => 10,
            "November" => 11,
            "Desember" => 12
        ];

        $bulanvalue = @$_GET['bulan'] ? $_GET['bulan'] : bulanSaatIni();
        $bulanNumeric = $bulanMapping[$bulanvalue];

        $pengerjaan = Pengerjaan::with('checklist')->where('mesin_id', $mesin_id)->whereMonth('tanggal', $bulanNumeric)->whereYear('tanggal', @$_GET['tahun'])->filter(request())->get();

        $data = [
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jeniskegiatan' => $jeniskegiatan,
            'pengerjaan' => $pengerjaan ?? [],
            'mesin' => $mesin,
            'bulanNumeric' => $bulanNumeric
        ];

        if (@$_GET['harian']) {
            toastr()->success('Berhasil export');
            // $pdf = PDF::loadView('exports.harian', [
            //     'mesin' => $mesin,
            //     'jeniskegiatan' => $jeniskegiatan,
            //     'pengerjaan' => $pengerjaan
            // ])->setPaper('landscape');

            // return $pdf->download('export maintenance harian ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . '.pdf');
            return Excel::download(new HarianExport($pengerjaan), 'export maintenance harian ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . ' .xlsx');
        }

        if (@$_GET['print']) {
            toastr()->success('Ctrl + Shift + p untuk print');

            return view('pages.dashboard.maintenance-harian.preview', [
                'lineproduksiname' => $lineproduksiname,
                'shiftname' => $shiftname,
                'shift' => $shift,
                'jeniskegiatan' => $jeniskegiatan,
                'pengerjaan' => $pengerjaan,
                'mesin' => $mesin,
                'bulanNumeric' => $bulanNumeric
            ]);
        }

        if (@$_GET['image']) {
            return view('pages.dashboard.maintenance-harian.image', [
                'lineproduksiname' => $lineproduksiname,
                'shiftname' => $shiftname,
                'lineproduksi' => $lineproduksi,
                'shift' => $shift,
                'jeniskegiatan' => $jeniskegiatan,
                'pengerjaan' => $pengerjaan,
                'mesin' => $mesin,
                'bulanNumeric' => $bulanNumeric
            ]);
        }

        return view('pages.dashboard.maintenance-harian.show', $data);
    }
}
