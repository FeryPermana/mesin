<?php

namespace App\Exports;

use App\Models\JenisKegiatan;
use App\Models\User; // Replace with your model
use Illuminate\Contracts\View\view;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class HarianExport implements FromView, WithEvents
{
    protected $pengerjaan;

    public function __construct($pengerjaan)
    {
        $this->pengerjaan = $pengerjaan;
    }

    public function view(): View
    {
        return view('exports.harian', [
            'jeniskegiatan' => JenisKegiatan::all(),
            'pengerjaan' => $this->pengerjaan
            // Replace with your data source
        ]);
    }

    // public function map($user): array
    // {
    //     return [
    //         $user->id,
    //         $user->name,
    //         $user->email,
    //     ];
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Apply custom colspan and rowspan
                $event->sheet->getDelegate()->mergeCells('A1:A2');
                $event->sheet->getDelegate()->mergeCells('B1:B2');
                $event->sheet->getDelegate()->mergeCells('C1:C2');
            },
        ];
    }
}
