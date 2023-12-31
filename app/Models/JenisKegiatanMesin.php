<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatanMesin extends Model
{
    use HasFactory;

    protected $table =  "jeniskegiatanmesin";
    protected $fillable = ['jenis_kegiatan_id', 'mesin_id', 'bulan', 'tahun', 'type'];

    public function jeniskegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id');
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }
}
