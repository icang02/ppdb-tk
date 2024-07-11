@extends('layouts.admin')
@section('main-content')
  <div class="card">
    <h5 class="card-header">
      <div class="d-flex justify-content-between">
        <div>Laporan Pembayaran</div>
        <a href="{{ route('cetak_lap_pembayaran') }}" class="btn btn-primary ms-2">Cetak</a>
      </div>
    </h5>
    <div class="card-body">

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>No Pendaftaran</th>
              <th>NIK</th>
              <th>No. Telp</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($dataPendaftar as $item)
              <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->no_pendaftaran }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nohp }}</td>
                <td style="max-width: 100px;" class="text-wrap">
                    @if ($item->slip_pembayaran != null)
                    <span class="badge bg-success">Lunas</span>
                    @else
                    <span class="badge bg-warning">Belum lunas</span>
                    @endif
                </td>
              </tr>
            @empty
              <tr class="text-center">
                <td colspan="7">Belum ada data.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
