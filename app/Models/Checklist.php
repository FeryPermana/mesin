<?php

namespace App\Models;

use App\Models\Checklist as ModelsChecklist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = "checklist";

    protected $fillable = ['harian', 'bersih', 'jenis_kegiatan_id', 'pengerjaan_id', 'is_check', 'bulan', 'tahun', 'gambar'];

    public function pengerjaan()
    {
        return $this->belongsTo(Pengerjaan::class);
    }

    public function jeniskegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'jenis_kegiatan_id');
    }
}
