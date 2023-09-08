<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\PerbaikanExport;
use App\Http\Controllers\Controller;
use App\Models\LineProduksi;
use App\Models\Mesin;
use App\Models\Perbaikan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminPerbaikanController extends Controller
{
    public function index()
    {
        $perbaikan = Perbaikan::join('mesin', 'perbaikan.mesin_id', '=', 'mesin.id')
            ->select('perbaikan.*', 'mesin.name as mesin_name')
            ->filter(request())
            ->get()
            ->groupBy('mesin_name');

        $data = [
            'perbaikan' => $perbaikan,
            'mesin' => Mesin::all(),
        ];

        return view('pages.dashboard.perbaikan.index', $data);
    }

    public function show($mesin_id)
    {
        $mesin = Mesin::findOrFail($mesin_id);

        $perbaikan = Perbaikan::with('mesin', 'lineproduksi')->filter(request())->where('mesin_id', $mesin_id)->get();
        $lineproduksi = LineProduksi::all();
        $shift = Shift::all();
        $shiftname = "";
        if (@$_GET['shift']) {
            $shiftname = Shift::whereId($_GET['shift'])->first()->name;
        }

        $lineproduksiname = "";
        if (@$_GET['lineproduksi']) {
            $lineproduksiname = LineProduksi::whereId($_GET['lineproduksi'])->first()->name;
        }

        $data = [
            'perbaikan' => $perbaikan,
            'mesin' => $mesin,
            'lineproduksi' => $lineproduksi,
            'shift' => $shift,
        ];

        if (@$_GET['image']) {
            return view('pages.dashboard.perbaikan.image', [
                'lineproduksiname' => $lineproduksiname,
                'shiftname' => $shiftname,
                'lineproduksi' => $lineproduksi,
                'shift' => $shift,
                'perbaikan' => $perbaikan,
                'mesin' => $mesin,
            ]);
        }

        if (@$_GET['export-perbaikan']) {

            // return $pdf->download('export maintenance harian ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . '.pdf');
            return Excel::download(new PerbaikanExport($perbaikan), 'export perbaikan export ' . $mesin->name . ' ' . $shiftname . ' line ' . $lineproduksiname . '.xlsx');
        }
        return view('pages.dashboard.perbaikan.show', $data);
    }

    public function update(Request $request, $id)
    {
        $perbaikan = Perbaikan::find($id);
        $perbaikan->status = $request->status;
        $perbaikan->update();

        return response()->json('success');
    }
}
