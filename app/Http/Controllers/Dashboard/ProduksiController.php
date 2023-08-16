<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index()
    {
        $shift = Shift::all();

        $data = [
            'shift' => $shift
        ];
        return view('pages.dashboard.produksi.index', $data);
    }
}
