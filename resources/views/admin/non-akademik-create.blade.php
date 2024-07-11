@extends('layouts.admin')
@section('main-content')
    <div class="card mb-4">
        <h5 class="card-header">
            <a href="{{ route('auth_non_akademik') }}" class="btn btn-secondary">Kembali</a>
        </h5>
        <div class="card-body">
            <div class="mb-4 fw-bold">Form Tambah Data Kegiatan Non Akademik</div>
            @include('components.admin.form.create-non-akademik', [
                'nonAkademik' => $nonAkademik ?? null,
            ])
        </div>
    </div>
@endsection
