<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonAkademik extends Model
{
    use HasFactory;
    protected $table = 'non_akademik';
    protected $guarded = [''];
    public $timestamps = false;
}
