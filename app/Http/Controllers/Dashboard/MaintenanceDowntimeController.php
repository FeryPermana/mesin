<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\DowntimeExport;
use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\Pengerjaan;
use App\Models\Perawatan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MaintenanceDowntimeController extends Controller
{
    public function index()
    {
        $maintenance = Perawatan::join('mesin', 'perawatan.mesin_id', '=', 'mesin.id')
            ->select('perawatan.*', 'mesin.name as mesin_name')
            ->filter(request())
            ->get()
            ->groupBy('mesin_name');

        $data = [
            'maintenance' => $maintenance,
            'mesin' => Mesin::all(),
            'shift' => Shift::all(),
            'lineproduksi' => LineProduksi::all(),
        ];

        return view('pages.dashboard.maintenance-downtime.index', $data);
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

        $perawatan = Perawatan::with('mesin', 'lineproduksi', 'lokasi')->filter(request())->where('mesin_id', $mesin_id)->get();

        $data = [
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jeniskegiatan' => $jeniskegiatan,
            'perawatan' => $perawatan,
            'mesin' => $mesin,
        ];

        if (@$_GET['export-downtime']) {
            toastr()->success('Berhasil export');

            // return $pdf->download('export maintenance harian ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . '.pdf');
            return Excel::download(new DowntimeExport($perawatan), 'export maintenance downtime ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . ' .xlsx');
        }

        return view('pages.dashboard.maintenance-downtime.show', $data);
    }
}
