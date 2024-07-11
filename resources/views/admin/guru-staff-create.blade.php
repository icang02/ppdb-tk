@extends('layouts.admin')
@section('main-content')
    <div class="card mb-4">
        <h5 class="card-header">
            <a href="{{ route('auth_guru_staff') }}" class="btn btn-secondary">Kembali</a>
        </h5>
        <div class="card-body">
            <div class="mb-4 fw-bold">Form Tambah Data Tenaga Pendidik</div>
            @include('components.admin.form.create-form', [
                'tenagaPendidik' => $tenagaPendidik ?? null,
            ])
        </div>
    </div>
@endsection
