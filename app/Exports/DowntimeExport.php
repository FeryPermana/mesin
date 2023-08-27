<?php

namespace App\Exports;

use Illuminate\Contracts\View\view;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DowntimeExport implements FromView
{
    protected $perawatan;

    public function __construct($perawatan)
    {
        $this->perawatan = $perawatan;
    }

    public function view(): View
    {
        return view('exports.downtime', [
            'perawatan' => $this->perawatan
        ]);
    }
}
