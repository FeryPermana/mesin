<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Downtime;
use App\Models\JamKerja;
use App\Models\LineProduksi;
use App\Models\Lokasi;
use App\Models\Mesin;
use App\Models\Perbaikan;
use App\Models\Shift;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerbaikanOperatorController extends Controller
{
    public function index()
    {
        $mesin = Mesin::all();

        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', @$_GET['mesinkey'])
            ->get();
        $lineproduksis = LineProduksi::all();
        $mesinone = Mesin::find(@$_GET['mesinkey']);
        $shift = Shift::all();
        $lokasi = Lokasi::all();
        $jenisdowntime = Downtime::all();
        $jamkerja = JamKerja::all();

        $perbaikan = Perbaikan::where('mesin_id', @$_GET['mesin'])->where('shift_id', @$_GET['shift'])->where('lineproduksi_id', @$_GET['lineproduksi'])->where('operator_id', auth()->user()->id)->get();

        $data = [
            'perbaikan' => $perbaikan,
            'mesinone' => $mesinone,
            'lokasi' => $lokasi,
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'lineproduksis' => $lineproduksis,
            'shift' => $shift,
            'jenisdowntime' => $jenisdowntime,
            'jamkerja' => $jamkerja
        ];
        return view('pages.dashboard.operator-perbaikan.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesin' => 'required',
            'shift' => 'required',
            'lineproduksi' => 'required',
            'tanggal_request' => 'required',
            'tanggal_update' => 'required',
            'action' => 'required',
            'pergantian_spare' => 'required',
            'gambar' => 'required'
        ]);

        // Tanggal dan waktu mulai dalam format datetime
        $startDate = new DateTime($request->tanggal_request); // Ganti dengan tanggal dan waktu mulai yang sesuai

        // Tanggal dan waktu selesai dalam format datetime
        $endDate = new DateTime($request->tanggal_update); // Ganti dengan tanggal dan waktu selesai yang sesuai

        // Menghitung selisih waktu
        $timeDifference = $startDate->diff($endDate);

        $perbaikan = new Perbaikan();
        $perbaikan->mesin_id = $request->mesin;
        $perbaikan->shift_id = $request->shift;
        $perbaikan->lineproduksi_id = $request->lineproduksi;
        $perbaikan->operator_id = auth()->user()->id;
        $perbaikan->tanggal_request = $request->tanggal_request;
        $perbaikan->tanggal_update = $request->tanggal_update;
        $perbaikan->action = $request->action;
        $perbaikan->pergantian_spare = $request->pergantian_spare;
        $perbaikan->status = 3;
        $perbaikan->lama_waktu = $timeDifference->format('%a hari, %h jam, %i menit, %s detik');
        $gambar = "";
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $gambar = time() . $image->getClientOriginalName();
            $image->move('upload/perbaikan', $gambar);

            $gambar = "upload/perbaikan/" . $gambar;
        }

        $perbaikan->gambar = $gambar;
        $perbaikan->save();

        return redirect('/dashboard/operator-perbaikan?mesinkey=' . $perbaikan->mesin_id . '&mesin=' . $perbaikan->mesin_id . '&shift=' . $perbaikan->shift_id . '&lineproduksi=' . $perbaikan->lineproduksi_id)->with('success', 'berhasil');
    }
}
