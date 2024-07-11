@extends('layouts.admin')
@section('main-content')
  <div class="card">
    <h5 class="card-header">Biodata Guru dan Staff</h5>
    <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
      @endif

      <form action="{{ route('auth_tanggal_pendaftaran_update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row g-3">
          <div class="col-lg-6">
            <div>
              <label for="tanggal_mulai" class="form-label">tanggal mulai</label>
              <input value="{{ old('tanggal_mulai', $data->tanggal_mulai) }}" name="tanggal_mulai" type="datetime-local"
                class="form-control" id="tanggal_mulai" required />
            </div>
          </div>
          <div class="col-lg-6">
            <div>
              <label for="tanggal_selesai" class="form-label">tanggal selesai</label>
              <input value="{{ old('tanggal_selesai', $data->tanggal_selesai) }}" name="tanggal_selesai"
                type="datetime-local" class="form-control" id="tanggal_selesai" required />
            </div>
          </div>
          <div class="col-lg-6">
            <div>
              <label for="tanggal_pengumuman" class="form-label">Tanggal pengumuman</label>
              <input value="{{ old('tanggal_pengumuman', $data->tanggal_pengumuman) }}" name="tanggal_pengumuman"
                type="datetime-local" class="form-control" id="tanggal_pengumuman" />
            </div>
          </div>
          <div class="col-lg-12">
            <div>
              <label for="status" class="form-label">status pendaftaran</label>
              <div>
                <div class="btn badge {{ $data->status == 'dibuka' ? 'btn-success' : 'btn-danger' }}">{{ $data->status }}
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">
              Simpan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
