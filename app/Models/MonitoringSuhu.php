<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringSuhu extends Model
{
    use HasFactory;

    protected $table = "monitoring_suhu";
    protected $fillable = [
        'tanggal',
        'suhu',
        'rh',
        'keterangan',
        'operator_id'
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('suhu', 'LIKE', '%' . $params->search . '%')
                    ->orWhere('rh', 'LIKE', '%' . $params->search . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $params->search . '%');
            });
        }

        if (@$params->operator) {
            $query->where(function ($query) use ($params) {
                $query->where('operator_id', 'LIKE', '%' . $params->operator . '%');
            });
        }

        if (@$params->bulan) {
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
            $bulanvalue = @$params->bulan ? @$params->bulan : bulanSaatIni();
            $bulanNumeric = $bulanMapping[$bulanvalue];

            $query->where(function ($query) use ($bulanNumeric) {
                $query->whereMonth('tanggal', $bulanNumeric);
            });
        }

        if (@$params->tahun) {
            $query->where(function ($query) use ($params) {
                $query->whereYear('tanggal', $params->tahun);
            });
        }
    }
}
