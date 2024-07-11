<!DOCTYPE html>
<html>

<head>
  <title>Laporan Hasil Seleksi Peserta Didik Baru Periode {{ date('Y') . '/' . date('Y') + 1 }}</title>
  <style>
    /* Gaya CSS untuk kop surat */
    #kop-surat {
      text-align: center;
      margin-bottom: 20px;
    }

    #kop-surat img {
      width: 100px;
      height: auto;
    }

    #kop-surat h2 {
      margin: 0;
      font-size: 18px;
    }

    /* Gaya CSS untuk tabel */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #2f2f2f;
      padding: 4px 8px;
    }

    @page {
      margin: 0.6cm 1cm;
    }

    body {
      margin: 0.6cm 1cm;
    }
  </style>
</head>

<body style="line-height: 23px">
  <div id="kop-surat">
    <img src="{{ asset('guest/img/logo-tk.png') }}" alt="logo"
      style="position: absolute; left: 11; top: 14; width: 140px">

    <div style="transform: translateX(25px)">
      @if (isset($pembayaran))
        <h2>LAPORAN PEMBAYARAN PESERTA DIDIK BARU</h2>
      @else
        <h2>LAPORAN HASIL SELEKSI PPDB</h2>
      @endif
      <h2>TAMAN KANAK-KANAK DHARMA MULYA</h2>
      <H2>TAHUN PELAJARAN {{ date('Y') . '/' . date('Y') + 1 }}</H2>
      <div style="margin-top: 6px; font-size: 13px">Alamat: Desa Wonua Raya, Kec. Baito, Kab. Konawe Selatan, Sulawei
        Tenggara</div>
    </div>

    <div style="width: 100%; height: 3px; background: black; margin-top: 12px;"></div>
  </div>

  @if (isset($pembayaran))
    <div style="margin-bottom: 10px; font-size: 14px">Laporan pembayaran biaya administarsi Peserta Didik Baru Taman
      Kanak-Kanak
      Dharma
      Mulya sebagai
      berikut.</div>
  @else
    <div style="margin-bottom: 10px; font-size: 14px">Hasil seleksi Penerimaan Peserta Didik Baru Taman Kanak-Kanak
      Dharma
      Mulya sebagai
      berikut.</div>
  @endif

  <table style="font-size: 13px;">
    <thead>
      <tr style="background-color: #fff">
        <th>NO.</th>
        <th>NAMA LENGKAP</th>
        <th>NIK</th>
        <th>Telp</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pendaftar as $item)
        @if (isset($pembayaran))
          <tr
            style="background-color: {{ $item->slip_pembayaran != null ? 'rgba(141,236,180,.7)' : 'rgba(255,187,112,.6)' }};">
          @else
          <tr
            style="background-color: {{ $item->status_kelulusan == 'lulus' ? 'rgba(141,236,180,.7)' : 'rgba(255,187,112,.6)' }};">
        @endif
        <td style="text-align: center">{{ $loop->iteration }}.</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->nik }}</td>
        <td>{{ $item->nohp }}</td>
        @if (isset($pembayaran))
          <td style="text-align: center">
            {{ $item->slip_pembayaran != null ? 'Lunas' : 'Belum lunas' }}
          </td>
        @else
          <td style="text-align: center">{{ strtoupper($item->status_kelulusan) }}</td>
        @endif
        </tr>
      @endforeach
    </tbody>
  </table>

  @php
    if (isset($pembayaran)) {
        $lulus = App\Models\Pendaftaran::where('slip_pembayaran', '!=', 'null')->count();
        $tidakLulus = App\Models\Pendaftaran::whereNull('slip_pembayaran')->count();
    } else {
        $lulus = App\Models\Pendaftaran::where('status_kelulusan', 'lulus')->count();
        $tidakLulus = App\Models\Pendaftaran::where('status_kelulusan', 'tidak lulus')->count();
    }

  @endphp
  <table style="font-size: 14px; width: 30%; line-height: 13px; margin-top: 9px; transform: translateX(-8px)">
    <tr>
      @if (isset($pembayaran))
        <td style="border: 0px">Lunas</td>
      @else
        <td style="border: 0px">Lulus</td>
      @endif
      <td style="border: 0px">:</td>
      <td style="border: 0px; font-weight: bold">{{ $lulus }} orang</td>
    </tr>
    <tr>
      @if (isset($pembayaran))
        <td style="border: 0px">Belum lunas</td>
      @else
        <td style="border: 0px">Tidak lulus</td>
      @endif
      <td style="border: 0px">:</td>
      <td style="border: 0px; font-weight: bold">{{ $tidakLulus }} orang</td>
    </tr>
  </table>

  <div style="position: relative; width: 35%; float: right; margin-top: 0px">
    @php
      $dateVerifikasi = App\Models\StatusPendaftaran::find(2)->tanggal_pengumuman;
      $kepsek = App\Models\TenagaPendidik::where('jabatan', 'Kepala Sekolah')->first()->nama;
    @endphp

    Konawe Selatan, {{ Carbon\Carbon::parse($dateVerifikasi)->isoFormat('D MMMM YYYY') }}<br>
    Kepala Sekolah <br><br><br><br>
    <b><u>{{ $kepsek }}</u></b>

    <img src="{{ asset('guest/img/ttd.png') }}" alt="ttd"
      style="width: 130px; position: absolute; top: 30; left: -10;">
    <img src="{{ asset('guest/img/stempel.png') }}" alt="ttd"
      style="width: 135px; position: absolute; top: 15; left: -45; opacity: 0.7;">
  </div>

</body>

</html>
