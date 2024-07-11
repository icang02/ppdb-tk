<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaBelajar extends Model
{
    use HasFactory;
    protected $table = 'tema_belajar';
    protected $guarded = [''];
    public $timestamps = false;

    // Relasi One-to-Many dengan model FotoTemaBelajar
    public function fotoTemaBelajar()
    {
        return $this->hasMany(
            FotoTemaBelajar::class,
            'tema_belajar_id'
        );
    }
}
