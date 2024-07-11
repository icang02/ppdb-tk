@extends('layouts.admin')
@section('main-content')
  <div class="card">
    <h5 class="card-header">Biodata Guru dan Staff</h5>
    <div class="card-body">
      <a href="{{ route('auth_guru_staff_create') }}" class="btn btn-primary mb-4">Tambah Data</a>

      @if (session('success'))
        <div class="alert alert-success mb-4">
          {{ session('success') }}
        </div>
      @endif

      <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Alamat</th>
              <th>Masa Pengabdian</th>
              <th>Foto</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tenagaPendidik as $item)
              <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->masa_pengabdian }}</td>
                <td>
                  <img src="{{ asset('storage/' . $item->foto) }}" width="50">
                </td>
                <td>
                  <a href="{{ route('auth_guru_staff_edit', $item->id) }}"
                    class="badge btn-info text-white cursor-pointer">Edit</a>
                  <a onclick="return confirm('Hapus data?')" href="{{ route('auth_guru_staff_destroy', $item->id) }}"
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
