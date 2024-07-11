@extends('layouts.admin')
@section('main-content')
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang!</h5>
                    <p class="mb-4">
                        Di Halaman Dashboard Sistem Informasi Taman Kanak-Kanak Dharma Mulya <br>
                        Desa Wonua Raya, Kec. Baito, Kab. Konawe Selatan, Sulawei Tenggara
                    </p>

                    <a href="{{ route('beranda') }}" class="btn btn-sm btn-outline-primary">Halaman Beranda</a>
                </div>
            </div>
        </div>
    </div>
@endsection
