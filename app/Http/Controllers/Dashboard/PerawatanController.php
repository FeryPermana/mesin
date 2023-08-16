<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\JenisKegiatan;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\Pengerjaan;
use App\Models\Perawatan;
use App\Models\Shift;
use Illuminate\Http\Request;

class PerawatanController extends Controller
{
    public function index()
    {
        $mesin = Mesin::all();
        $lineproduksi = LineProduksi::all();
        $shift = Shift::all();
        $jeniskegiatan = JenisKegiatan::all();

        $pengerjaan = Pengerjaan::with('checklist')->filter(request())->whereNik(auth()->user()->nik)->get();

        $data = [
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jeniskegiatan' => $jeniskegiatan,
            'pengerjaan' => $pengerjaan,
        ];

        return view('pages.dashboard.perawatan.index', $data);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'tanggal' => 'required',
            'mesin' => 'required',
            'shift' => 'required',
            'lineproduksi' => 'required',
            'jenis_kegiatan' => 'required',
            'gambar' => 'required'
        ]);

        $pengerjaan = new Pengerjaan();
        $pengerjaan->tanggal = $request->tanggal;
        $pengerjaan->mesin_id = $request->mesin;
        $pengerjaan->shift_id = $request->shift;
        $pengerjaan->nik = auth()->user()->nik;
        $pengerjaan->lineproduksi_id = $request->lineproduksi;

        $gambar = "";
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $gambar = time() . $image->getClientOriginalName();
            $image->move('upload', $gambar);

            $gambar = "upload/" . $gambar;
        }

        $pengerjaan->gambar = $gambar;
        $pengerjaan->save();

        $jenis_kegiatan = $request->jenis_kegiatan;

        $jenkeg = JenisKegiatan::all();
        foreach ($jenkeg as $jk) {
            if (in_array($jk->id, $jenis_kegiatan)) {
                $checklist = new Checklist();
                $checklist->jenis_kegiatan_id = $jk->id;
                $checklist->pengerjaan_id = $pengerjaan->id;
                $checklist->is_check = 1;
                $checklist->harian = date('d');
                $checklist->save();
            } else {
                $checklist = new Checklist();
                $checklist->jenis_kegiatan_id = $jk->id;
                $checklist->pengerjaan_id = $pengerjaan->id;
                $checklist->is_check = 0;
                $checklist->harian = date('d');
                $checklist->save();
            }
        }

        return redirect()->back()->with('success', 'berhasil');
    }
}
