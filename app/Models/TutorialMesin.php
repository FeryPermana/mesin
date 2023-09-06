<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialMesin extends Model
{
    use HasFactory;

    protected $table = "tutorialmesin";

    protected $fillable = ['title', 'mesin_id', 'lineproduksi_id', 'deskripsi', 'file', 'video'];

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }

    public function scopeFilter($query, $params)
    {
        if (@$params->tutorialmesin) {
            $query->where(function ($query) use ($params) {
                $query->whereId(@$params->tutorialmesin);
            });
        }
    }
}
