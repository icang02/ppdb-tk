<?php

namespace App\Http\Controllers;

use App\Models\TemaBelajar;
use Illuminate\Http\Request;

class AkademikController extends Controller
{
    public function guestIndex()
    {
        return view('akademik', [
            'title' => 'Akademik',
            'description' => 'Setiap informasi dan kegiatan akademik kami dirangkum secara komprehensif untuk memberikan gambaran menyeluruh tentang pendidikan yang kami laksanakan. Adapun tema pembelajaran dapat dilihat pada daftar list di bawah ini.',
            'tema' => TemaBelajar::all(),
        ]);
    }
}
