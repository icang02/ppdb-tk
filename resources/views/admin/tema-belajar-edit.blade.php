@extends('layouts.admin')
@section('main-content')
    <div class="card mb-4">
        <h5 class="card-header">
            <a href="{{ route('auth_tema_belajar') }}" class="btn btn-secondary">Kembali</a>
        </h5>
        <div class="card-body">
            <div class="mb-4 fw-bold">Form Edit Tema Pembelajaran</div>

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @error('foto[]')
                <div class="alert alert-danger mb-4">{{ $message }}</div>
            @enderror
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth_tema_belajar_update', $tema->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div>
                            <label for="nama_tema" class="form-label">Nama Tema</label>
                            <input value="{{ old('nama_tema', $tema->nama_tema) }}" name="nama_tema" type="text"
                                class="form-control" id="nama_tema" />
                        </div>
                        @error('nama_tema')
                            <small class="mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="foto" class="form-label">Upload Foto</label>
                            <input multiple name="foto[]" type="file" class="form-control" id="foto" />
                        </div>
                        <small class="mt-1">Format file : png, jpg, jpeg</small>
                        @error('foto')
                            <small class="mt-1 text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <hr>
            <div class="text-center">Foto Kegiatan</div>
            <hr>

            <div class="row g-3">
                @foreach ($tema->fotoTemaBelajar as $item)
                    <div class="col-lg-3" style="position: relative;">
                        <img class="img-fluid border border-secondary" src="{{ asset('storage/' . $item->foto) }}"
                            alt="{{ $item->foto }}"
                            style="width: 100%; height: 150px; object-fit: cover; border-radius: 6px;">

                        <div style="position: absolute; top: 0; right: 0; background-color: red; border-radius: 6px;">
                            <a href="{{ route('auth_tema_belajar_destroy_foto', $item->id) }}"
                                onclick="return confirm('Hapus foto?')" class="text-white px-2 fw-bold">
                                x
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
