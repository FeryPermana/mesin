<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $table = 'sparepart';
    protected $fillable = ['item', 'jumlah', 'tanggal_update', 'user_id', 'keterangan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('item', 'LIKE', '%' . $params->search . '%');
            });
        }
    }
}
