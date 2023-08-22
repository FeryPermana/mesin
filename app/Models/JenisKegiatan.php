<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jenis_kegiatan';
    protected $fillable = ['name'];

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('name', 'LIKE', '%' . $params->search . '%');
            });
        }
    }

    public function jeniskegiatanmesin()
    {
        return $this->hasMany(JenisKegiatanMesin::class);
    }

    public function checklist()
    {
        return $this->hasMany(Checklist::class);
    }
}
