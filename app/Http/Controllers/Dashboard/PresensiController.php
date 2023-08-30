<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use App\Models\Presensi;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function index()
    {
        $mesin = Mesin::all();

        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', @$_GET['mesinkey'])
            ->get();
        $mesinone = Mesin::find(@$_GET['mesinkey']);
        $shift = Shift::all();

        $data = [
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'mesinone' => $mesinone,
            'shift' => $shift,
        ];

        return view('pages.dashboard.presensi.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesin' => 'required',
            'lineproduksi' => 'required',
            'shift' => 'required',
            'tanggal' => 'required'
        ]);
        $presensilast = Presensi::where('user_id', auth()->user()->id)->where('lineproduksi_id', $request->lineproduksi)->where('shift_id', $request->shift)->whereYear('tanggal', date('Y'))->whereMonth('tanggal', date('m'))->first();
        if ($presensilast) {
            return redirect()->back()->with('error', 'Anda sudah presensi !!!');
        }

        Presensi::create([
            'user_id' => auth()->user()->id,
            'lineproduksi_id' => $request->lineproduksi,
            'shift_id' => $request->shift,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil !!!');
    }
}
