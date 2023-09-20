<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    use HasFactory;

    protected $table = "reject";
    protected $fillable = [
        'tanggal',
        'shift_id',
        'lineproduksi_id',
        'jam_kerja_id',
        'reject_botol',
        'reject_tutup',
        'reject_produksi',
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
        return $this->belongsTo(JamKerja::class, 'jam_kerja_id');
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

        if (@$params->lineproduksi) {
            $query->where(function ($query) use ($params) {
                $query->where('lineproduksi_id', 'LIKE', '%' . $params->lineproduksi . '%');
            });
        }
    }
}
