<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;

    protected $table = "mesin";

    protected $fillable = ['code', 'name', 'merk', 'kapasitas', 'lokasi_id', 'tahun_pembuatan', 'periode_pakai'];

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('name', 'LIKE', '%' . $params->search . '%');
            });
        }

        if (@$params->lokasi) {
            $query->where(function ($query) use ($params) {
                $query->where('lokasi_id', 'LIKE', '%' . $params->lokasi . '%');
            });
        }
    }

    public function tutorialmesin()
    {
        return $this->hasMany(TutorialMesin::class);
    }

    public function hasline()
    {
        return $this->hasMany(HasLine::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function perawatan()
    {
        return $this->hasMany(Perawatan::class);
    }

    public function jeniskegiatanmesin()
    {
        return $this->hasMany(JenisKegiatanMesin::class);
    }
}
