@extends('layouts.guest')

@section('main-content')
    @include('components.guest.menu-hero', ['title' => $title])

    <div class="container-fluid gallery py-5 my-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">TK Darma Mulya</h5>
            <h1 class="mb-4">{{ $title }}</h1>
            <p class="mb-0">{{ $description }}
            </p>
        </div>
        <div class="tab-class text-center">
            <div class="tab-content">
                <div id="GalleryTab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-2">
                        @foreach ($prestasi as $item)
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="gallery-item h-100">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid w-100 h-100 rounded"
                                        alt="Image" style="height: 10px !important; object-fit: cover;">
                                    <div class="gallery-content">
                                        <div class="gallery-info">
                                            <h5 class="text-white text-uppercase mb-2">{{ $item->juara }}</h5>
                                            <p class="text-white">{{ $item->nama_kegiatan }}</p>
                                        </div>
                                    </div>
                                    <div class="gallery-plus-icon">
                                        <a href="{{ url('storage/' . $item->foto) }}" data-lightbox="gallery-1"
                                            class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
