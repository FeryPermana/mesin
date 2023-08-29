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
        $data = [
            'presensi' => Presensi::filter(request())->paginate(@$_GET['row'] ?? 10),
            'lineproduksi' => LineProduksi::all(),
            'shift' => Shift::all()
        ];

        return view('pages.dashboard.report-presensi.index', $data);
    }
}
