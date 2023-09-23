<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\Produksi;
use App\Models\Shift;
use Illuminate\Http\Request;

class AdminProduksiController extends Controller
{
    public function index()
    {
        $produksis = Produksi::filter(request())->get();

        $tanggal = Produksi::select('tanggal')->groupBy('tanggal')->get();

        $shifts = Shift::all();

        $lineproduksis = LineProduksi::all();

        $data = [
            'produksis' => $produksis,
            'tanggal' => $tanggal,
            'shifts' => $shifts,
            'lineproduksis' => $lineproduksis
        ];

        return view('pages.dashboard.admin-produksi.index', $data);
    }
}
