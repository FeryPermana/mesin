<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    use HasFactory;

    protected $table = "perawatan";

    protected $fillable = ['mesin_id', 'lineproduksi_id', 'lokasi_id', 'shift_id', 'nik', 'jam_kerja_id', 'downtime_id', 'jenis_kegiatan_id', 'tanggal', 'finish', 'action_plan', 'lama_waktu'];

    public function pengerjaan()
    {
        return $this->belongsTo(Pengerjaan::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function jamkerja()
    {
        return $this->belongsTo(JamKerja::class, 'jam_kerja_id');
    }

    public function downtime()
    {
        return $this->belongsTo(Downtime::class);
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class, 'mesin_id', 'id');
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function scopeFilter($query, $params)
    {
        if (@$params->mesin) {
            $query->where(function ($query) use ($params) {
                $query->where('mesin_id', $params->mesin);
            });
        }

        if (@$params->lineproduksi) {
            $query->where(function ($query) use ($params) {
                $query->where('lineproduksi_id', $params->lineproduksi);
            });
        }

        if (@$params->shift) {
            $query->where(function ($query) use ($params) {
                $query->where('shift_id', $params->shift);
            });
        }
    }
}
