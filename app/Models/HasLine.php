<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasLine extends Model
{
    use HasFactory;

    protected $table = "hasline";
    protected $fillable = ['lineproduksi_id', 'mesin_id'];

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }
}
