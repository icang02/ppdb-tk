@extends('layouts.admin')
@section('main-content')
    <div class="card mb-4">
        <h5 class="card-header">
            <a href="{{ route('auth_prestasi') }}" class="btn btn-secondary">Kembali</a>
        </h5>
        <div class="card-body">
            <div class="mb-4 fw-bold">Form Tambah Data Prestasi</div>
            @include('components.admin.form.create-prestasi', [
                'prestasi' => $prestasi ?? null,
            ])
        </div>
    </div>
@endsection
