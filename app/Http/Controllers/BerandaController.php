<?php

namespace App\Http\Controllers;

use App\Models\TenagaPendidik;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('beranda', [
            'kepsek' => TenagaPendidik::where('jabatan', 'Kepala Sekolah')->first(),
        ]);
    }
}
