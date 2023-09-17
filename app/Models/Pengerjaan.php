<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengerjaan extends Model
{
    use HasFactory;

    protected $table = "pengerjaan";
    protected $fillable = ['mesin_id', 'shift_id', 'nik', 'tanggal', 'lineproduksi_id', 'checklist_id'];

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('name', 'LIKE', '%' . $params->search . '%');
            });
        }

        if (@$params->mesin) {
            $query->where(function ($query) use ($params) {
                $query->where('mesin_id', $params->mesin);
            });
        }

        if (@$params->shift) {
            $query->where(function ($query) use ($params) {
                $query->where('shift_id', $params->shift);
            });
        }

        if (@$params->lineproduksi) {
            $query->where(function ($query) use ($params) {
                $query->where('lineproduksi_id', $params->lineproduksi);
            });
        }
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    public function checklist()
    {
        return $this->hasMany(Checklist::class);
    }
}
