<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\JenisKegiatan;
use App\Models\JenisKegiatanMesin;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\Pengerjaan;
use App\Models\Perawatan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatanController extends Controller
{
    public function index()
    {
        $mesin = Mesin::all();
        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', @$_GET['mesinkey'])
            ->get();
        $shift = Shift::all();
        $jeniskegiatan = JenisKegiatan::all();

        if (@$_GET['mesinkey']) {
            $jeniskegiatan = DB::table('jenis_kegiatan')
                ->join('jeniskegiatanmesin', 'jenis_kegiatan.id', '=', 'jeniskegiatanmesin.jenis_kegiatan_id')
                ->select('jenis_kegiatan.*', 'jenis_kegiatan.name', 'jenis_kegiatan.standart')
                ->where('jeniskegiatanmesin.mesin_id', @$_GET['mesinkey'])
                ->where('jeniskegiatanmesin.bulan', bulanSaatIni())
                ->where('jeniskegiatanmesin.tahun', date('Y'))
                ->where('jeniskegiatanmesin.type', 'harian')
                ->get();
        }

        $bulanMapping = [
            "Januari" => 1,
            "Februari" => 2,
            "Maret" => 3,
            "April" => 4,
            "Mei" => 5,
            "Juni" => 6,
            "Juli" => 7,
            "Agustus" => 8,
            "September" => 9,
            "Oktober" => 10,
            "November" => 11,
            "Desember" => 12
        ];

        $bulanvalue = @$_GET['bulan'] ? $_GET['bulan'] : bulanSaatIni();
        $bulanNumeric = $bulanMapping[$bulanvalue];

        $pengerjaan = Pengerjaan::with('checklist')->where('mesin_id', @$_GET['mesinkey'])->whereMonth('tanggal', $bulanNumeric)->whereYear('tanggal', @$_GET['tahun'])->filter(request())->get();

        $data = [
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
            'jeniskegiatan' => $jeniskegiatan,
            'pengerjaan' => $pengerjaan,
            'method' => 'store',
            'url' => route('perawatan.store')
        ];

        return view('pages.dashboard.perawatan.index', $data);
    }

    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'tanggal' => 'required',
            'mesin' => 'required',
            'shift' => 'required',
            'lineproduksi' => 'required',

        ]);

        $countpengerjaan = Pengerjaan::where('shift_id', $request->shift)->where('lineproduksi_id', $request->lineproduksi)->where('mesin_id', $request->mesin)->get()->count();

        if ($countpengerjaan == 31) {
            return redirect()->back()->with('error', 'checklist sudah selesai !!');
        } else {
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

            $jenis_kegiatan = $request->jenis_kegiatan ?? [];

            $jenkeg = DB::table('jenis_kegiatan')
                ->join('jeniskegiatanmesin', 'jenis_kegiatan.id', '=', 'jeniskegiatanmesin.jenis_kegiatan_id')
                ->select('jenis_kegiatan.*', 'jenis_kegiatan.name', 'jenis_kegiatan.standart')
                ->where('jeniskegiatanmesin.mesin_id', $request->mesin)
                ->where('jeniskegiatanmesin.bulan', bulanSaatIni())
                ->where('jeniskegiatanmesin.tahun', date('Y'))
                ->where('jeniskegiatanmesin.type', 'harian')
                ->get();

            foreach ($jenkeg as $key => $jk) {
                if (in_array($jk->id, $jenis_kegiatan)) {
                    $arr = array_search($jk->id, $jenis_kegiatan);
                    $checklist = new Checklist();
                    $checklist->jenis_kegiatan_id = $jk->id;
                    $checklist->pengerjaan_id = $pengerjaan->id;
                    $checklist->is_check = 1;
                    $checklist->harian = date('d');
                    $checklist->bulan = bulanSaatIni();
                    $checklist->tahun = date('Y');
                    $img = "";
                    if ($request->hasFile('img')) {
                        $image = $request->img[$arr] ?? null;
                        if ($image != null) {
                            $img = time() . $image->getClientOriginalName();
                            $image->move('upload/pengerjaan', $img);

                            $img = "upload/pengerjaan/" . $img;
                            $checklist->gambar = $img;
                        }
                    }

                    $checklist->save();
                } else {
                    $checklist = new Checklist();
                    $checklist->jenis_kegiatan_id = $jk->id;
                    $checklist->pengerjaan_id = $pengerjaan->id;
                    $checklist->is_check = 0;
                    $checklist->harian = date('d');
                    $checklist->bulan = bulanSaatIni();
                    $checklist->tahun = date('Y');

                    $checklist->save();
                }
            }

            return redirect('/dashboard/perawatan?mesinkey=' . $pengerjaan->mesin_id . '&mesin=' . $pengerjaan->mesin_id . '&shift=' . $pengerjaan->shift_id . '&lineproduksi=' . $pengerjaan->lineproduksi_id)->with('success', 'berhasil');
        }
    }

    public function edit($id)
    {
        $pengerjaanedit = Pengerjaan::with('checklist')->whereId($id)->first();

        $pengerjaan = Pengerjaan::with('checklist')->filter(request())->get();

        $jeniskegiatan = DB::table('jenis_kegiatan')
            ->join('jeniskegiatanmesin', 'jenis_kegiatan.id', '=', 'jeniskegiatanmesin.jenis_kegiatan_id')
            ->select('jenis_kegiatan.*', 'jenis_kegiatan.name', 'jenis_kegiatan.standart')
            ->where('jeniskegiatanmesin.mesin_id', $pengerjaanedit->mesin_id)
            ->where('jeniskegiatanmesin.bulan', bulanSaatIni())
            ->where('jeniskegiatanmesin.tahun', date('Y'))
            ->where('jeniskegiatanmesin.type', 'harian')
            ->get();

        $lineproduksi = DB::table('lineproduksi')
            ->join('hasline', 'lineproduksi.id', '=', 'hasline.lineproduksi_id')
            ->select('lineproduksi.*', 'lineproduksi.name')
            ->where('hasline.mesin_id', $pengerjaanedit->mesin_id)
            ->get();
        $shift = Shift::all();

        $data = [
            'pengerjaan' => $pengerjaan,
            'pengerjaanedit' => $pengerjaanedit,
            'mesin' => Mesin::all(),
            'method' => 'update',
            'url' => route('perawatan.update', $pengerjaanedit->id),
            'jeniskegiatan' => $jeniskegiatan,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift
        ];

        return view('pages.dashboard.perawatan.index', $data);
    }

    public function update(Request $request, $id)
    {
        $pengerjaanedit = Pengerjaan::with('checklist')->whereId($id)->first();

        $jenkeg = DB::table('jenis_kegiatan')
            ->join('jeniskegiatanmesin', 'jenis_kegiatan.id', '=', 'jeniskegiatanmesin.jenis_kegiatan_id')
            ->select('jenis_kegiatan.*', 'jenis_kegiatan.name', 'jenis_kegiatan.standart')
            ->where('jeniskegiatanmesin.mesin_id', $pengerjaanedit->mesin_id)
            ->where('jeniskegiatanmesin.bulan', bulanSaatIni())
            ->where('jeniskegiatanmesin.tahun', date('Y'))
            ->where('jeniskegiatanmesin.type', 'harian')
            ->get();

        $pengerjaan = Pengerjaan::find($id);
        $gambar = $pengerjaan->gambar;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $gambar = time() . $image->getClientOriginalName();
            $image->move('upload', $gambar);

            $gambar = "upload/" . $gambar;
        }

        $pengerjaan->gambar = $gambar;
        $pengerjaan->save();

        $jenis_kegiatan = $request->jenis_kegiatan ?? [];
        Checklist::where('pengerjaan_id', $id)->delete();
        foreach ($jenkeg as $key => $jk) {
            if (in_array($jk->id, $jenis_kegiatan)) {
                $arr = array_search($jk->id, $jenis_kegiatan);
                $checklist = new Checklist();
                $checklist->jenis_kegiatan_id = $jk->id;
                $checklist->pengerjaan_id = $id;
                $checklist->is_check = 1;
                $checklist->harian = date('d');
                $checklist->bulan = bulanSaatIni();
                $checklist->tahun = date('Y');
                $img = "";
                if ($request->hasFile('img')) {
                    $image = $request->img[$arr] ?? null;
                    if ($image != null) {
                        $img = time() . $image->getClientOriginalName();
                        $image->move('upload/pengerjaan', $img);

                        $img = "upload/pengerjaan/" . $img;
                        $checklist->gambar = $img;
                    }
                }

                $checklist->save();
            } else {
                $checklist = new Checklist();
                $checklist->jenis_kegiatan_id = $jk->id;
                $checklist->pengerjaan_id = $id;
                $checklist->is_check = 0;
                $checklist->harian = date('d');
                $checklist->bulan = bulanSaatIni();
                $checklist->tahun = date('Y');

                $checklist->save();
            }
        }
        return redirect('/dashboard/perawatan?mesinkey=' . $pengerjaanedit->mesin_id . '&mesin=' . $pengerjaanedit->mesin_id . '&shift=' . $pengerjaanedit->shift_id . '&lineproduksi=' . $pengerjaanedit->lineproduksi_id)->with('success', 'berhasil');
    }
}
