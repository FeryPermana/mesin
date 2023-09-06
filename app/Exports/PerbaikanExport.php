<?php

namespace App\Exports;

use Illuminate\Contracts\View\view;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PerbaikanExport implements FromView
{
    protected $perbaikan;

    public function __construct($perbaikan)
    {
        $this->perbaikan = $perbaikan;
    }

    public function view(): View
    {
        return view('exports.perbaikan', [
            'perbaikan' => $this->perbaikan
        ]);
    }
}
