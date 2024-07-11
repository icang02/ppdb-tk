@php
    if (Route::is('guest_akademik')) {
        $foto = 'akademik.webp';
    } else {
        $foto = 'non-akademik.jpg';
    }
@endphp
@extends('layouts.guest')

@section('main-content')
    @include('components.guest.menu-hero', ['title' => $title])

    <div class="container-fluid destination py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">TK Dharma Mulya</h5>
                <h1 class="mb-4">Kegiatan {{ $title }}</h1>
                <p>{{ $description }}</p>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    @foreach ($tema as $i => $item)
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill @if ($i == 0) active @endif"
                                data-bs-toggle="pill" href="#{{ str()->slug($item->nama_tema) }}">
                                <span class="text-dark px-4">{{ $item->nama_tema }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($tema as $i => $item)
                        <div id="{{ str()->slug($item->nama_tema) }}"
                            class="tab-pane fade show p-0 @if ($i == 0) active @endif">
                            <div class="row g-4">
                                @forelse ($item->fotoTemaBelajar as $j => $itemFoto)
                                    <div class="col-lg-6">
                                        <div class="destination-img">
                                            <img class="img-fluid rounded w-100"
                                                src="{{ asset('storage/' . $itemFoto->foto) }}" alt=""
                                                style="height: 350px; object-fit: cover;">
                                            <div class="destination-overlay p-4">
                                                <a href="{{ url('storage/img/' . $itemFoto->foto) }}"
                                                    data-lightbox="{{ $item->nama_tema }}"
                                                    class="btn btn-primary text-white rounded-pill border py-2 px-3">
                                                    Dokumentasi - {{ $j + 1 }}
                                                </a>
                                            </div>
                                            <div class="search-icon">
                                                <a href="{{ url('storage/' . $itemFoto->foto) }}"
                                                    data-lightbox="{{ $item->nama_tema }}"><i
                                                        class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <h6>Tema {{ $item->nama_tema }} belum ada data.</h6>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
