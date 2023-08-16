<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Downtime;
use App\Models\JamKerja;
use App\Models\Shift;
use Illuminate\Http\Request;

class TeknisiDowntimeController extends Controller
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
        return view('pages.dashboard.teknisi-downtime.index', $data);
    }
}
