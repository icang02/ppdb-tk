@php
    $title = 'Guru & Staff';
@endphp

@extends('layouts.guest')

@section('main-content')
    @include('components.guest.menu-hero', ['title' => $title])

    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">TK Dharma Mulya</h5>
                <h1 class="mb-4">Data Tenaga Pendidik</h1>
                <p class="mb-0">
                    TK Dharma Mulya memiliki tenaga pendidik berjumlah {{ $tenagaPendidik->count() }} orang, di mana
                    terdiri dari Guru yang berjumlah {{ $jumlahGuru }} orang dan Staff TU yang berjumlah
                    {{ $jumlahStaff }} orang. Biodata guru dan staff dapat dilihat di bawah ini.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($tenagaPendidik as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item">
                            <div class="blog-img">
                                <div class="blog-img-inner">
                                    <img class="img-fluid w-100 rounded-top" src="{{ asset('storage/' . $item->foto) }}"
                                        alt="Image" style="object-fit: cover; height: 450px !important;">
                                </div>
                            </div>
                            <div class="blog-content border border-top-0 rounded-bottom p-4">
                                <p class="mb-3">Jabatan : <span class="fw-bold">{{ $item->jabatan }}</span></p>
                                <a href="#" class="h4">{{ $item->nama }}</a>
                                <div class="mt-3">
                                    <p class="my-1">Alamat : <span class="fw-bold">{{ $item->alamat }}</span></p>
                                    <p class="my-1">Tempat, Tanggal Lahir : <span
                                            class="fw-bold">{{ $item->ttg }}</span></p>
                                    <p class="my-1">Masa Pengabdian : <span
                                            class="fw-bold">{{ $item->masa_pengabdian }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
