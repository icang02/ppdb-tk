@php
  $biaya = [
      [
          'biaya' => 'Pendaftaran',
          'nominal' => 'Rp.30.000,00',
          'periode' => 'Sekali',
      ],
      [
          'biaya' => 'Komite',
          'nominal' => 'Rp.35.000,00',
          'periode' => 'Setiap bulan',
      ],
      [
          'biaya' => 'Raport',
          'nominal' => 'Rp.25.000,00',
          'periode' => 'Sekali',
      ],
      [
          'biaya' => 'Foto',
          'nominal' => 'Rp.65.000,00',
          'periode' => 'Sekali',
      ],
      [
          'biaya' => 'Seragam',
          'nominal' => 'Rp.450.000,00',
          'periode' => 'Sekali',
      ],
  ];
@endphp

@extends('layouts.guest')
@section('main-content')
  @include('components.guest.menu-hero', ['title' => $title])

  <div class="container-fluid ExploreTour py-5">
    <div class="container py-5">
      <div class="mx-auto text-center mb-5" style="max-width: 900px;">
        <h5 class="section-title px-3">TK Dharma Mulya</h5>
        <h1 class="mb-4">{{ $title }}</h1>
        <p class="mb-0">Selamat datang di Halaman Pendaftaran Siswa Baru TK Dharma Mulya, tempat dimulainya
          perjalanan pendidikan yang penuh inspirasi untuk anak-anak Anda. Kami membuka pintu untuk calon
          siswa-siswi yang bersemangat dan ingin mengalami pendidikan berkualitas dalam lingkungan belajar yang
          mendukung.
        </p>
      </div>
      <div class="tab-class text-center">
        <ul class="nav nav-pills d-inline-flex justify-content-center mb-4">
          <li class="nav-item">
            <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill @if (!session('submit')) active @endif"
              data-bs-toggle="pill" href="#syarat">
              <span class="text-dark" style="width: 250px;">Alur & Syarat Pendaftaran</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#biaya">
              <span class="text-dark" style="width: 250px;">Biaya Pendidikan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill @if (session('submit')) active @endif"
              data-bs-toggle="pill" href="#formulir">
              <span class="text-dark" style="width: 250px;">Formulir Pendaftaran</span>
            </a>
          </li>
        </ul>
        <div class="tab-content text-start">
          <div id="syarat" class="tab-pane fade show p-0 @if (!session('submit')) active @endif">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-7">
                <h4 class="mb-4">Tata Cara Pendaftaran PPDB Online secara Umum</h4>
                <ol class="mb-4">
                  <li>Membuka situs Sistem Informasi TK Dharma Mulya</li>
                  <li>Pilih menu pendaftaran</li>
                  <li>Klik menu formulir pendaftaran</li>
                  <li>Mengisi formulir Pra Pendaftaran Online</li>
                  <li>Menunggu Verifikasi Pendaftaran</li>
                  <li>Melihat pengumuman kelulusan</li>
                </ol>

                <h4 class="mb-4">Persyaratan Berkas</h4>
                <ol>
                  <li>Fotokopi Kartu Keluarga</li>
                  <li>Fotokopi KTP Ayah dan Ibu</li>
                  <li>Formulir pendaftaran. Format dapat diunduh melalui link berikut : <a
                      href="{{ route('download_formulir') }}">Formulir Pendaftaran</a>
                  </li>
                  <li>Foto 3x4 3 (tiga) lembar</li>
                </ol>
              </div>
            </div>
          </div>
          <div id="biaya" class="tab-pane fade show p-0">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-7">
                <h4 class="mb-4">Biaya Pendidikan TKN Dharma Mulya</h4>
                <table class="table table-bordered border border-dark">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Biaya</th>
                      <th scope="col">Nominal</th>
                      <th scope="col">Periode Pembayaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($biaya as $item)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>
                        <td>{{ $item['biaya'] }}</td>
                        <td>{{ $item['nominal'] }}</td>
                        <td>{{ $item['periode'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="formulir" class="tab-pane fade show p-0 @if (session('submit')) active @endif">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-7">
                <p class="mb-4 lh-lg">
                  Status pendaftaran : <span
                    class="badge fw-bold {{ $statusPendaftaran->status == 'dibuka' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($statusPendaftaran->status) }}
                  </span>

                  <br>

                  Tanggal mulai : <span class="fw-bold">
                    @if ($statusPendaftaran->status == 'dibuka')
                      {{ $statusPendaftaran->tanggal_mulai }}
                      — {{ $statusPendaftaran->tanggal_selesai }} WITA
                    @else
                      -
                    @endif
                  </span>

                  <br>

                  @if ($statusPendaftaran->status != 'dibuka' && $statusPendaftaran->tanggal_pengumuman != null)
                    Pengumuman : <span class="fw-bold">{{ $statusPendaftaran->tanggal_pengumuman }} WITA</span>
                  @endif
                </p>

                <p class="mb-4">
                  Sebelum memulai pengisian formulir online, pastikan untuk memeriksa waktu dan
                  tanggal pendaftaran yang berlaku. Silakan isi formulir dengan data yang valid dan
                  lengkap untuk memastikan kelancaran proses penerimaan.
                </p>

                @if (session('error'))
                  <div class="alert alert-danger mb-4">
                    {!! session('error') !!}
                  </div>
                @endif
                @if (session('success'))
                  <div class="alert alert-success mb-4">
                    <h5 class="mb-3">{!! session('success') !!}</h5>
                    <ul>
                      <li>No. pendaftaran : <span class="fw-bold">{{ session('no_pendaftaran') }}</span></li>
                      <li>Nama Lengkap : <span class="fw-bold">{{ session('nama') }}</span></li>
                      <li>NIK : <span class="fw-bold">{{ session('nik') }}</span></li>
                      <li>Phone : <span class="fw-bold">{{ session('nohp') }}</span></li>
                    </ul>
                  </div>
                @endif
                @if (session('info'))
                  <div class="alert alert-info mb-4">{!! session('info') !!}</div>
                @endif
                @if (session('successLulus'))
                  <div class="alert alert-success mb-4">{!! session('successLulus') !!}</div>
                @endif
                @if (session('tidakLulus'))
                  <div class="alert alert-danger mb-4">{!! session('tidakLulus') !!}</div>
                @endif

                <form method="POST" action="{{ route('guest_submit_pendaftaran') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input value="{{ old('nama') }}" name="nama" type="text"
                          class="form-control bg-white border-1" id="nama" placeholder="Nama Lengkap">
                        <label for="nama">Nama Lengkap <span class="text-danger h6">*</span></label>
                      </div>
                      @error('nama')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input name="umurTahun" type="number" class="form-control bg-white border-1" min="0"
                              id="umurTahun" placeholder="Usia (tahun)" required>
                            <label for="umur">Usia (tahun) <span class="text-danger h6">*</span></label>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input name="umurBulan" type="number" class="form-control bg-white border-1" min="0"
                              max="12" id="umurBulan" placeholder="Usia (bulan)" required>
                            <label for="umur">Usia (bulan) <span class="text-danger h6">*</span></label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input value="{{ old('nik') }}" name="nik" type="text"
                          class="form-control bg-white border-1" id="nik" placeholder="Nomor Induk Kependudukan"
                          maxlength="16">
                        <label for="nik">Nomor Induk Kependudukan <span class="text-danger h6">*</span></label>
                      </div>
                      @error('nik')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating date" id="nohp">
                        <input value="{{ old('nohp') }}" name="nohp" type="text"
                          class="form-control bg-white border-1" id="nohp"
                          placeholder="No. Handpone yang dapat dihubungi" />
                        <label for="nohp">Telpon yang bisa dihubungi <span class="text-danger h6">*</span></label>
                      </div>
                      @error('nohp')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input value="{{ old('kk') }}" name="kk" type="file"
                          class="form-control bg-white border-1" id="kk" placeholder="Upload Kartu Keluarga"
                          accept=".png,.jpg,.pdf">
                        <label for="kk" style="margin-top: -6px;">Upload Kartu
                          Keluarga</label>
                      </div>
                      <small class="mt-2">Format file : png, jpg, pdf</small> <span class="text-danger h6">*</span>
                      @error('kk')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input name="ktp" type="file" class="form-control bg-white border-1" id="ktp"
                          placeholder="Upload KTP suami/istri" accept=".png,.jpg,.pdf">
                        <label for="ktp" style="margin-top: -6px;">Upload KTP
                          suami/Istri</label>
                      </div>
                      <small class="mt-2">Format file : png, jpg, pdf</small> <span class="text-danger h6">*</span>
                      @error('ktp')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input name="formulir" type="file" class="form-control bg-white border-1" id="formulir"
                          placeholder="Upload Formulir Pendaftaran" accept=".pdf">
                        <label for="formulir" style="margin-top: -6px;">Upload
                          Formulir Pendaftaran</label>
                        <small class="mt-2">Format file : pdf</small> <span class="text-danger h6">*</span>
                        @error('formulir')
                          <small class="text-danger mt-1 d-block">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input name="foto" type="file" class="form-control bg-white border-1" id="foto"
                          placeholder="Upload Pas Foto" accept=".png,.jpg,.jpeg">
                        <label for="foto" style="margin-top: -6px;">Pas Foto</label>
                      </div>
                      <small class="mt-2">Format file : png, jpg, jpeg</small> <span class="text-danger h6">*</span>
                      @error('foto')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-md-12">
                      <p class="mt-1 mb-2">Khusus pendaftar di luar wilayah <b>Kabupaten Konawe Selatan</b>, wajib
                        mencamtumkan
                        surat keterangan
                        domisili saat ini.</p>
                      <div class="form-floating">
                        <input name="surat_domisili" type="file" class="form-control bg-white border-1"
                          id="surat_domisili" placeholder="Upload Pas surat_domisili" accept=".pdf">
                        <label for="surat_domisili" style="margin-top: -6px;">Surat Keterangan Domisili</label>
                      </div>
                      <small class="mt-2">Format file : pdf</small> <span class="text-black h6">*</span>
                      @error('surat_domisili')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="col-12">
                      <div class="d-flex align-items-start">
                        <button class="btn btn-primary text-white w-25 py-2" type="submit">Daftar</button>
                        <small class="ms-3">Pastikan format file dan data yang dimasukkan sudah
                          benar.</small>
                      </div>
                    </div>
                  </div>
                </form>

                <hr class="my-4">

                @if ($statusPendaftaran->status == 'ditutup')
                  <p class="mb-4">
                    Untuk cek status kelulusan, silahkan masukkan no. pendaftaran atau NIK pada form
                    di bawah.
                  </p>
                  <form method="POST" action="{{ route('guest_cek_kelulusan') }}">
                    @csrf
                    <div class="row g-3">
                      <div class="col-md-10">
                        <div class="form-floating">
                          <input value="{{ old('nik_cek') }}" name="nik_cek" type="text"
                            class="form-control bg-white border-1" id="nik_cek" placeholder="No. pendaftaran / NIK"
                            required>
                          <label for="nik_cek">No. pendaftaran / NIK</label>
                        </div>
                      </div>
                      <div class="col-2">
                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                      </div>
                    </div>
                  </form>

                  <hr class="my-4">
                @endif


                @if (session('successLulus'))
                  <p class="mb-3">
                    Form upload pembayaran biaya administrasi.
                  </p>
                  <p class="mb-3">
                    No. Rekening : <b>2259 0100 4363 538 (Taman Kanak-Kanak Dharma Mulya)</b> <br>
                    Nama Bank : <b>BRI</b>
                  </p>
                  <p>Untuk rincian biaya pendidikan dapat dilihat pada menu <span
                      style="text-decoration: underline">Biaya
                      Pendidikan</span>.</p>

                  <form method="POST" action="{{ route('guest_unggah_pembayaran') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                      <div class="col-md-10">
                        <div class="form-floating">
                          <input value="{{ old('slip') }}" name="slip" type="file"
                            class="form-control bg-white border-1" id="slip" placeholder="slip" required>
                          <label for="slip">Slip Bayar</label>
                        </div>
                        <input type="hidden" name="nik" value="{{ old('nik_cek') }}">
                        @error('slip')
                          <small class="text-danger mt-1 d-block">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="col-2">
                        <button class="btn btn-primary text-white" type="submit">Unggah</button>
                      </div>
                    </div>
                  </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
