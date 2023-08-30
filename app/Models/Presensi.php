<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = "presensi";
    protected $fillable = ['user_id', 'lineproduksi_id', 'shift_id', 'tanggal'];


    public function scopeFilter($query, $params)
    {
        if (@$params->lineproduksi) {
            $query->where(function ($query) use ($params) {
                $query->where('lineproduksi_id', 'LIKE', '%' . $params->lineproduksi . '%');
            });
        }

        if (@$params->shift) {
            $query->where(function ($query) use ($params) {
                $query->where('shift_id', 'LIKE', '%' . $params->shift . '%');
            });
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
