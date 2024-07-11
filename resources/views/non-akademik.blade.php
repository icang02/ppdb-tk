@php
    $foto = 'non-akademik.jpg';
@endphp
@extends('layouts.guest')

@section('main-content')
    @include('components.guest.menu-hero', ['title' => $title])

    <div class="container-fluid guide py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">TK Dharma Mulya</h5>
                <h1 class="mb-4">Kegiatan {{ $title }}</h1>
                <p>{{ $description }}</p>
            </div>
            <div class="row g-4">
                @forelse ($nonAkademik as $item)
                    <div class="col-lg-6">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid w-100 rounded-top"
                                        alt="Image" style="height: 320px; object-fit: cover;">
                                </div>
                                <div class="guide-icon rounded-pill px-4 py-2 fw-bold">
                                    {{ $item->judul }}
                                </div>
                            </div>
                            <div class="guide-title rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <p class="mt-5">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h6>Belum ada data.</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
