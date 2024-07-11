@extends('layouts.admin')
@section('main-content')
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('auth_tema_belajar_store') }}" method="post" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Tema Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_tema" class="form-label">Nama Tema</label>
                            <input value="{{ old('nama_tema') }}" type="text" id="nama_tema" class="form-control"
                                name="nama_tema" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Tema Pembelajaran</h5>
        <div class="card-body">
            <button class="btn btn-primary mb-4" type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#basicModal">Tambah Data</button>

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @error(session('nama_tema'))
                <div class="alert alert-danger mb-4">{{ $message }}</div>
            @enderror

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Tema</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tema as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->nama_tema }}</td>
                                <td>
                                    <a href="{{ route('auth_tema_belajar_edit', $item->id) }}"
                                        class="badge btn-info text-white cursor-pointer">Edit</a>
                                    <a onclick="return confirm('Hapus data?')"
                                        href="{{ route('auth_tema_belajar_destroy', $item->id) }}"
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
