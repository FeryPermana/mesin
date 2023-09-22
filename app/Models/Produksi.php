<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $table = "produksi";
    protected $fillable = [
        'tanggal',
        'shift_id',
        'lineproduksi_id',
        'jam_kerja_id',
        'pallet',
        'keterangan'
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function jamkerja()
    {
        return $this->belongsTo(JamKerja::class);
    }

    public function scopeFilter($query, $params)
    {
        if (@$params->tanggal) {
            $query->where(function ($query) use ($params) {
                $query->where('tanggal', 'LIKE', '%' . $params->tanggal . '%');
            });
        }

        if (@$params->shift) {
            $query->where(function ($query) use ($params) {
                $query->where('shift_id', 'LIKE', '%' . $params->shift . '%');
            });
        }
    }
}
