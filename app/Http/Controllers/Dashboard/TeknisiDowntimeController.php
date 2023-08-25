<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Downtime;
use App\Models\JamKerja;
use App\Models\Lokasi;
use App\Models\Mesin;
use App\Models\Perawatan;
use App\Models\Shift;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeknisiDowntimeController extends Controller
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
        $lokasi = Lokasi::all();
        $jenisdowntime = Downtime::all();
        $jamkerja = JamKerja::all();

        $perawatan = Perawatan::filter(request())->where('nik', auth()->user()->nik)->get();

        $data = [
            'perawatan' => $perawatan,
            'mesinone' => $mesinone,
            'lokasi' => $lokasi,
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jenisdowntime' => $jenisdowntime,
            'jamkerja' => $jamkerja
        ];
        return view('pages.dashboard.teknisi-downtime.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesin' => 'required',
            'shift' => 'required',
            'lokasi' => 'required',
            'lineproduksi' => 'required',
            'downtime' => 'required',
            'action_plan' => 'required',
            'jamkerja' => 'required',
            'tanggal' => 'required',
            'finish' => 'required',
            'gambar' => 'required'
        ]);

        // Tanggal dan waktu mulai dalam format datetime
        $startDate = new DateTime($request->tanggal); // Ganti dengan tanggal dan waktu mulai yang sesuai

        // Tanggal dan waktu selesai dalam format datetime
        $endDate = new DateTime($request->finish); // Ganti dengan tanggal dan waktu selesai yang sesuai

        // Menghitung selisih waktu
        $timeDifference = $startDate->diff($endDate);

        $perawatan = new Perawatan();
        $perawatan->mesin_id = $request->mesin;
        $perawatan->shift_id = $request->shift;
        $perawatan->lokasi_id = $request->lokasi;
        $perawatan->lineproduksi_id = $request->lineproduksi;
        $perawatan->nik = auth()->user()->nik;
        $perawatan->downtime_id = $request->downtime;
        $perawatan->action_plan = $request->action_plan;
        $perawatan->jam_kerja_id = $request->jamkerja;
        $perawatan->tanggal = $request->tanggal;
        $perawatan->finish = $request->finish;
        $perawatan->lama_waktu = $timeDifference->format('%a hari, %h jam, %i menit, %s detik');
        $gambar = "";
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $gambar = time() . $image->getClientOriginalName();
            $image->move('upload/downtime', $gambar);

            $gambar = "upload/downtime/" . $gambar;
        }

        $perawatan->gambar = $gambar;
        $perawatan->save();

        return redirect('/dashboard/teknisi-downtime?mesinkey=' . $perawatan->mesin_id . '&mesin=' . $perawatan->mesin_id . '&shift=' . $perawatan->shift_id . '&lineproduksi=' . $perawatan->lineproduksi_id)->with('success', 'Berhasil');
    }
}
