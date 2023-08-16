<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Downtime;
use App\Models\JamKerja;
use App\Models\Perawatan;
use App\Models\Shift;
use Illuminate\Http\Request;

class OperatorDowntimeController extends Controller
{
    public function index()
    {
        $shift = Shift::all();
        $jenisdowntime = Downtime::all();
        $jamkerja = JamKerja::all();

        $data = [
            'shift' => $shift,
            'jenisdowntime' => $jenisdowntime,
            'jamkerja' => $jamkerja
        ];
        return view('pages.dashboard.operator-downtime.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'shift' => 'required',
            'downtime' => 'required',
            'action_plan' => 'required',
            'jamkerja' => 'required',
            'tanggal' => 'required',
            'finish' => 'required',
            'lama_waktu' => 'required',
            'gambar' => 'required'
        ]);

        $perawatan = new Perawatan();
        $perawatan->shift_id = $request->shift;
        $perawatan->nik = auth()->user()->nik;
        $perawatan->downtime_id = $request->downtime;
        $perawatan->action_plan = $request->action_plan;
        $perawatan->jam_kerja_id = $request->jamkerja;
        $perawatan->tanggal = $request->tanggal;
        $perawatan->finish = $request->finish;
        $perawatan->lama_waktu = $request->lama_waktu;
        $gambar = "";
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $gambar = time() . $image->getClientOriginalName();
            $image->move('upload/downtime', $gambar);

            $gambar = "upload/downtime/" . $gambar;
        }

        $perawatan->gambar = $gambar;
        $perawatan->save();

        return redirect()->back()->with('success', 'silahkan isi');
    }
}
