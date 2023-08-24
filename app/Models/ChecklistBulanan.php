<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistBulanan extends Model
{
    use HasFactory;

    protected $table = "checklist_bulanan";

    protected $fillable = ['bulan', 'bersih', 'jenis_kegiatan_id', 'pengerjaan_bulanan_id', 'is_check', 'bulanan', 'tahun'];

    public function pengerjaanbulanan()
    {
        return $this->belongsTo(PengerjaanBulanan::class);
    }

    public function jeniskegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'jenis_kegiatan_id');
    }
}
