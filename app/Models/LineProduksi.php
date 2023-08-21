<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineProduksi extends Model
{
    use HasFactory;

    protected $table = 'lineproduksi';

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('name', 'LIKE', '%' . $params->search . '%');
            });
        }
    }
}
