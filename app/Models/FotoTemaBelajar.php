<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoTemaBelajar extends Model
{
    use HasFactory;
    protected $table = 'foto_tema_belajar';
    protected $guarded = [''];
    public $timestamps = false;

    // Relasi One-to-One dengan model TemaBelajar
    public function temaBelajar()
    {
        return $this->belongsTo(TemaBelajar::class, 'tema_belajar_id');
    }
}
