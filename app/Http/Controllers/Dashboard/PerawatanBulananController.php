<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ChecklistBulanan;
use App\Models\JenisKegiatan;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\PengerjaanBulanan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatanBulananController extends Controller
{
    public function index()
    {
        $mesin = Mesin::all();
        $lineproduksi = LineProduksi::all();
        $shift = Shift::all();
        $jeniskegiatan = JenisKegiatan::all();

        if (@$_GET['mesinkey']) {
            $jeniskegiatan = DB::table('jenis_kegiatan')
                ->join('jeniskegiatanmesin', 'jenis_kegiatan.id', '=', 'jeniskegiatanmesin.jenis_kegiatan_id')
                ->select('jenis_kegiatan.*', 'jenis_kegiatan.name', 'jenis_kegiatan.standart')
                ->where('jeniskegiatanmesin.mesin_id', @$_GET['mesinkey'])
                ->where('jeniskegiatanmesin.bulan', bulanSaatIni())
                ->where('jeniskegiatanmesin.tahun', date('Y'))
                ->where('jeniskegiatanmesin.type', 'bulanan')
                ->get();
        }

        $pengerjaan = PengerjaanBulanan::with('checklistbulanan')->filter(request())->get();

        $data = [
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jeniskegiatan' => $jeniskegiatan,
            'pengerjaan' => $pengerjaan,
        ];

        return view('pages.dashboard.perawatan-bulanan.index', $data);
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

        $countpengerjaan = PengerjaanBulanan::where('shift_id', $request->shift)->where('lineproduksi_id', $request->lineproduksi)->get()->count();

        if ($countpengerjaan == 1) {
            return redirect()->back()->with('error', 'checklist sudah selesai !!');
        } else {
            $pengerjaan = new PengerjaanBulanan();
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

            $jenis_kegiatan = $request->jenis_kegiatan ?? [];

            $jenkeg = DB::table('jenis_kegiatan')
                ->join('jeniskegiatanmesin', 'jenis_kegiatan.id', '=', 'jeniskegiatanmesin.jenis_kegiatan_id')
                ->select('jenis_kegiatan.*', 'jenis_kegiatan.name', 'jenis_kegiatan.standart')
                ->where('jeniskegiatanmesin.mesin_id', $request->mesin)
                ->where('jeniskegiatanmesin.bulan', bulanSaatIni())
                ->where('jeniskegiatanmesin.tahun', date('Y'))
                ->where('jeniskegiatanmesin.type', 'bulanan')
                ->get();

            foreach ($jenkeg as $jk) {
                if (in_array($jk->id, $jenis_kegiatan)) {
                    $checklist = new ChecklistBulanan();
                    $checklist->jenis_kegiatan_id = $jk->id;
                    $checklist->pengerjaan_bulanan_id = $pengerjaan->id;
                    $checklist->is_check = 1;
                    $checklist->bulan = date('d');
                    $checklist->save();
                } else {
                    $checklist = new ChecklistBulanan();
                    $checklist->jenis_kegiatan_id = $jk->id;
                    $checklist->pengerjaan_bulanan_id = $pengerjaan->id;
                    $checklist->is_check = 0;
                    $checklist->bulan = date('d');
                    $checklist->save();
                }
            }

            return redirect('/dashboard/perawatan-bulanan?mesinkey=' . $pengerjaan->mesin_id . '&mesin=' . $pengerjaan->mesin_id . '&shift=' . $pengerjaan->shift_id . '&lineproduksi=' . $pengerjaan->lineproduksi_id)->with('success', 'berhasil');
        }
    }
}
