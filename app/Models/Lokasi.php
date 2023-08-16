<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = "lokasi";
    protected $fillable = ['kode', 'lokasi'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function mesin()
    {
        return $this->hasMany(Mesin::class);
    }

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('name', 'LIKE', '%' . $params->search . '%');
            });
        }
    }
}
