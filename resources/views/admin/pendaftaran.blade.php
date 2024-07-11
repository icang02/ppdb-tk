@php
  $cekData = \App\Models\Pendaftaran::all();
  $cekBelumVerifikasi = \App\Models\Pendaftaran::where('status_kelulusan', 'belum verifikasi');

  $cekStatus = \App\Models\StatusPendaftaran::find(2)->status;
@endphp

@extends('layouts.admin')
@section('main-content')
  <div class="card">
    <h5 class="card-header">
      <div class="d-flex justify-content-between">
        <div>Data Pendaftar</div>

        @can('admin')
          @if ($cekStatus == 'verifikasi')
            <a href="{{ route('cetak') }}" class="btn btn-primary ms-2">Cetak</a>
          @endif
        @endcan

        @can('kepsek')
          <div>
            @if ($cekStatus == 'verifikasi')
              <button class="btn btn-dark" disabled>Data Terverifikasi</button>
              <form action="{{ route('auth_verifikasi_data') }}" method="post" class="d-inline">
                @csrf
                <input type="hidden" name="status_verifikasi" value="belum verifikasi">
                <button onclick="return confirm('Batalkan verifikasi?')" type="submit"
                  class="btn btn-dark">Batalkan</button>
              </form>

              <a href="{{ route('cetak') }}" class="btn btn-primary ms-2">Cetak</a>
            @else
              @if ($cekData->count() != 0)
                @if ($cekBelumVerifikasi->count() == 0)
                  <form action="{{ route('auth_verifikasi_data') }}" method="post">
                    @csrf
                    <input type="hidden" name="status_verifikasi" value="verifikasi">
                    <button onclick="return confirm('Konfirmasi data pendaftar?')" type="submit"
                      class="btn btn-dark">Verifikasi Pendaftar</button>
                  </form>
                @else
                  <button class="btn btn-dark" disabled>Verifikasi Pendaftar</button>
                @endif
              @else
                <button class="btn btn-dark" disabled>Verifikasi Pendaftar</button>
              @endif
            @endif
          </div>
        @endcan
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
              <th>File Pendukung</th>
              <th>Status</th>
              <th>Aksi</th>
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
                  <a href="{{ url('storage/' . $item->kk) }}" class="badge bg-primary text-white">Kartu
                    Keluarga</a>
                  <a href="{{ url('storage/' . $item->ktp) }}" class="badge bg-primary text-white">KTP Orang Tua</a>
                  <a href="{{ url('storage/' . $item->formulir) }}" class="badge bg-primary text-white">Formulir</a>
                  <a href="{{ url('storage/' . $item->foto) }}" class="badge bg-primary text-white">Pas
                    Foto</a>
                  @if ($item->slip_pembayaran)
                    <a href="{{ url('storage/' . $item->slip_pembayaran) }}" class="badge bg-warning text-white">Slip
                      Bayar</a>
                  @endif
                  @if ($item->surat_domisili)
                    <a href="{{ url('storage/' . $item->surat_domisili) }}" class="badge bg-secondary text-white">Surat
                      Domisili</a>
                  @endif
                </td>

                <td>
                  @can('admin')
                    {{-- form status kelulusan --}}
                    <form class="form_status_kelulusan{{ $item->id }} d-none"
                      action="{{ route('auth_verifikasi_pendaftaran', $item->id) }}" method="POST">
                      @csrf
                      @method('put')
                      <input type="hidden" name="status_kelulusan" id="status_kelulusan{{ $item->id }}">
                      <button type="button" class="btn btn-primary">
                        Lulus
                      </button>
                    </form>

                    <div class="form-check">
                      <input @disabled($cekStatus == 'verifikasi') @checked($item->status_kelulusan == 'belum verifikasi') class="form-check-input"
                        type="radio" name="statusVerifikasi{{ $item->id }}" id="belumVerifikasi{{ $item->id }}"
                        value="belum verifikasi"
                        onclick="handleBtnBelumVerifikasi({{ $item->id }}, 'belum verifikasi')">
                      <label
                        class="form-check-label {{ $item->status_kelulusan == 'belum verifikasi' ? 'fw-bold' : 'text-dark' }}"
                        for="belumVerifikasi{{ $item->id }}">
                        Belum Verifikasi
                      </label>
                    </div>

                    <div class="form-check">
                      <input @disabled($cekStatus == 'verifikasi') @checked($item->status_kelulusan == 'lulus') class="form-check-input"
                        type="radio" name="statusVerifikasi{{ $item->id }}" id="lulus{{ $item->id, 'lulus' }}"
                        value="lulus" onclick="handleBtnLulus({{ $item->id }}, 'lulus')">
                      <label
                        class="form-check-label {{ $item->status_kelulusan == 'lulus' ? 'text-success fw-bold' : 'text-dark' }}"
                        for="lulus{{ $item->id }}">
                        Lulus
                      </label>
                    </div>

                    <div class="form-check">
                      <input @disabled($cekStatus == 'verifikasi') @checked($item->status_kelulusan == 'tidak lulus') class="form-check-input"
                        type="radio" name="statusVerifikasi{{ $item->id }}" id="tidakLulus{{ $item->id }}"
                        value="tidak lulus" onclick="handleBtnTidakLulus({{ $item->id }})">
                      <label
                        class="form-check-label {{ $item->status_kelulusan == 'tidak lulus' ? 'text-danger fw-bold' : 'text-dark' }}"
                        for="tidakLulus{{ $item->id }}">
                        Tidak Lulus
                      </label>
                    </div>

                    {{-- modal tidak lulus --}}
                    <button type="button" class="btn btn-primary d-none" id="btnTidakLulus{{ $item->id }}"
                      data-bs-toggle="modal" data-bs-target="#modalKeterangan{{ $item->id }}">
                      Launch
                    </button>

                    <form action="{{ route('auth_keterangan_pendaftaran', $item->id) }}" method="post">
                      @csrf
                      @method('put')
                      <div class="modal fade" id="modalKeterangan{{ $item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $item->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel{{ $item->id }}">Keterangan
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                onclick="btnCloseModal({{ $item->id }},`{{ $item->status_kelulusan }}`)"></button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Alasan tidak lulus</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan" required>{{ $item->keterangan }}</textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                onclick="btnCloseModal({{ $item->id }},`{{ $item->status_kelulusan }}`)">Kembali</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>
                    </form>

                    <script>
                      function btnCloseModal(id, status) {
                        if (status == 'belum verifikasi') {
                          var radio = document.getElementById(`belumVerifikasi${id}`);
                        } else if (status == 'lulus') {
                          var radio = document.getElementById(`lulus${id}`);
                        } else {
                          var radio = document.getElementById(`tidakLulus${id}`);
                        }
                        radio.checked = true; // Tetapkan status radio button menjadi checked
                      }
                    </script>
                  </td>
                @endcan

                @can('kepsek')
                  @if ($item->status_kelulusan == 'belum verifikasi')
                    <span class="fw-bold text-dark">{{ ucfirst($item->status_kelulusan) }}</span>
                  @elseif ($item->status_kelulusan == 'lulus')
                    <span class="fw-bold text-success">{{ ucfirst($item->status_kelulusan) }}</span>
                  @elseif ($item->status_kelulusan == 'tidak lulus')
                    <span class="fw-bold text-danger">{{ ucfirst($item->status_kelulusan) }}</span>
                  @endif
                @endcan
                </td>

                <td>
                  <button data-bs-toggle="modal" data-bs-target="#modalLihat{{ $item->id }}"
                    class="badge bg-dark text-white">Lihat</button>
                  @can('admin')
                    @if ($cekStatus == 'verifikasi')
                      <button disabled class="badge btn btn-danger text-white">Hapus</button>
                    @else
                      <a href="{{ route('auth_pendaftaran_destroy', $item->id) }}"
                        onclick="return confirm('Hapus data?')" class="badge btn btn-danger text-white">Hapus</a>
                    @endif
                  @endcan
                </td>
              </tr>

              <!-- Modal lihat -->
              <div class="modal fade" id="modalLihat{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Informasi Data Pendaftar</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-9">
                          <div class="row mb-2">
                            <div class="col-md-4">No. Pendaftaran</div>
                            <div class="col-md-8 ms-auto fw-bold">:&nbsp; {{ $item->no_pendaftaran }}</div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">Nama Lengkap</div>
                            <div class="col-md-8 ms-auto fw-bold">:&nbsp; {{ $item->nama }}</div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">NIK</div>
                            <div class="col-md-8 ms-auto fw-bold">:&nbsp; {{ $item->nik }}</div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">No. Telp Aktif</div>
                            <div class="col-md-8 ms-auto fw-bold">:&nbsp; {{ $item->nohp }}</div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">Berkas Pendukung</div>
                            <div class="col-md-8 ms-auto fw-bold text-wrap">:&nbsp;
                              <a href="{{ url('storage/' . $item->kk) }}" class="badge bg-primary text-white">Kartu
                                Keluarga</a>
                              <a href="{{ url('storage/' . $item->ktp) }}" class="badge bg-primary text-white">KTP</a>
                              <a href="{{ url('storage/' . $item->formulir) }}"
                                class="badge bg-primary text-white">Formulir</a>
                              <a href="{{ url('storage/' . $item->foto) }}" class="badge bg-primary text-white">Pas
                                Foto</a>
                              @if ($item->slip_pembayaran)
                                <a href="{{ url('storage/' . $item->slip_pembayaran) }}"
                                  class="badge bg-warning text-white">Slip
                                  Bayar</a>
                              @endif
                              @if ($item->surat_domisili)
                                <a href="{{ url('storage/' . $item->surat_domisili) }}"
                                  class="badge bg-secondary text-white">Surat
                                  Domisili</a>
                              @endif
                            </div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">Status Kelulusan</div>
                            <div class="col-md-8 ms-auto fw-bold">:&nbsp;
                              @if ($item->status_kelulusan == 'belum verifikasi')
                                <div class="badge btn btn-dark">{{ $item->status_kelulusan }}</div>
                              @elseif ($item->status_kelulusan == 'lulus')
                                <div class="badge btn btn-success">{{ $item->status_kelulusan }}</div>
                              @elseif ($item->status_kelulusan == 'tidak lulus')
                                <div class="badge btn btn-danger">{{ $item->status_kelulusan }}</div>
                              @endif
                            </div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">Waktu Registrasi</div>
                            <div class="col-md-8 ms-auto fw-bold">:&nbsp; {{ $item->created_at }} WITA</div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">Keterangan</div>
                            <div class="col-md-8 ms-auto fw-bold text-wrap">:&nbsp; {{ $item->keterangan ?? '-' }}</div>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->foto }}"
                            class="img-fluid w-100" style="height: 200px; object-fit: cover; object-position: center">
                        </div>

                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <tr class="text-center">
                <td colspan="7">Belum ada data.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        @if ($dataPendaftar->count() != 0)
          @php
            $countBelumVerifikasi = \App\Models\Pendaftaran::where('status_kelulusan', 'belum verifikasi')->count();
            $countLulus = \App\Models\Pendaftaran::where('status_kelulusan', 'lulus')->count();
            $countTidakLulus = \App\Models\Pendaftaran::where('status_kelulusan', 'tidak lulus')->count();
          @endphp

          <div class="mt-3 float-end text-end">
            <div>Belum verifikasi : <span class="fw-bold">{{ $countBelumVerifikasi }} orang</span></div>
            <div>Lulus : <span class="fw-bold">{{ $countLulus }} orang</span></div>
            <div>Tidak lulus : <span class="fw-bold">{{ $countTidakLulus }} orang</span></div>
          </div>
        @endif
      </div>
    </div>
  </div>


  <script>
    function handleBtnBelumVerifikasi(id, status) {
      //   alert(status)
      document.getElementById(`status_kelulusan${id}`).value = status;
      document.querySelector(`.form_status_kelulusan${id}`).submit();
    }

    function handleBtnLulus(id, status) {
      //   alert(status)
      document.getElementById(`status_kelulusan${id}`).value = status;
      document.querySelector(`.form_status_kelulusan${id}`).submit();
    }

    function handleBtnTidakLulus(id) {
      var btnTidakLulus = document.getElementById(`btnTidakLulus${id}`)
      btnTidakLulus.click();
    }
  </script>
@endsection
