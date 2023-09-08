<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    protected $table = "perbaikan";

    protected $fillable = [
        'id_perbaikan',
        'tanggal_request',
        'tanggal_update',
        'lama_waktu',
        'operator_id',
        'teknisi_id',
        'mesin_id',
        'shift_id',
        'lineproduksi_id',
        'action',
        'pergantian_spare',
        'status',
        'gambar',
        'operator_gambar',
        'kerusakan'
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class, 'mesin_id');
    }

    public function scopeFilter($query, $params)
    {
        if (@$params->mesin) {
            $query->where(function ($query) use ($params) {
                $query->where('mesin_id', $params->mesin);
            });
        }

        if (@$params->teknisi) {
            $query->where(function ($query) use ($params) {
                $query->where('teknisi_id', $params->teknisi);
            });
        }

        if (@$params->shift) {
            $query->where(function ($query) use ($params) {
                $query->where('shift_id', $params->shift);
            });
        }
        if (@$params->lineproduksi) {
            $query->where(function ($query) use ($params) {
                $query->where('lineproduksi_id', $params->lineproduksi);
            });
        }
    }
}
