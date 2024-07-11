@extends('layouts.admin')
@section('main-content')
    <div class="card">
        <h5 class="card-header">Kegiatan Non Akademik</h5>
        <div class="card-body">
            <a href="{{ route('auth_prestasi_create') }}" class="btn btn-primary mb-4">Tambah Data</a>

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestasi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->foto) }}" width="150">
                                </td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->juara }}</td>
                                <td>
                                    <a href="{{ route('auth_prestasi_edit', $item->id) }}"
                                        class="badge btn-info text-white cursor-pointer">Edit</a>
                                    <a onclick="return confirm('Hapus data?')"
                                        href="{{ route('auth_prestasi_destroy', $item->id) }}"
                                        class="badge btn-danger text-white cursor-pointer">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
