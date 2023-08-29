<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialMesin extends Model
{
    use HasFactory;

    protected $table = "tutorialmesin";

    protected $fillable = ['mesin_id', 'lineproduksi_id', 'deskripsi', 'file', 'video'];

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    public function lineproduksi()
    {
        return $this->belongsTo(LineProduksi::class);
    }
}
