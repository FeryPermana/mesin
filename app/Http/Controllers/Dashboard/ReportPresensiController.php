<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\Presensi;
use App\Models\Shift;
use Illuminate\Http\Request;

class ReportPresensiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 1) {
            $presensi = Presensi::filter(request())->paginate(@$_GET['row'] ?? 10);
        } else {
            $presensi = Presensi::filter(request())->whereHas('user', function ($query) {
                $query->where('lokasi_id', auth()->user()->lokasi_id);
            })->paginate(@$_GET['row'] ?? 10);
        }

        $data = [
            'presensi' => $presensi,
            'lineproduksi' => LineProduksi::all(),
            'shift' => Shift::all()
        ];

        return view('pages.dashboard.report-presensi.index', $data);
    }
}
