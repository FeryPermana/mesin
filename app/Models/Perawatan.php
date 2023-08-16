<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    use HasFactory;

    protected $table = "perawatan";

    protected $fillable = ['pengerjaan_id', 'shift_id', 'nik', 'jam_kerja_id', 'downtime_id', 'jenis_kegiatan_id', 'tanggal', 'finish', 'action_plan', 'lama_waktu'];

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
        return $this->belongsTo(JamKerja::class);
    }

    public function downtime()
    {
        return $this->belongsTo(Downtime::class);
    }
}
