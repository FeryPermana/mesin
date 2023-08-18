<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistMingguan extends Model
{
    use HasFactory;

    protected $table = "checklist_mingguan";

    protected $fillable = ['mingguan', 'bersih', 'jenis_kegiatan_id', 'pengerjaan_mingguan_id', 'is_check'];

    public function pengerjaanmingguan()
    {
        return $this->belongsTo(PengerjaanMingguan::class);
    }

    public function jeniskegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'jenis_kegiatan_id');
    }
}
