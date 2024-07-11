<div class="container-fluid subscribe py-5"
    style="background: linear-gradient(rgba(19, 53, 123, .6), rgba(19, 53, 123, .6)), url({{ asset('guest/img/beranda-hero.webp') }}) !important; background-size: cover !important; background-position: center center; background-repeat: no-repeat !important; background-attachment: fixed !important;">
    <div class="container text-center py-5">
        <div class="mx-auto text-center" style="max-width: 900px;">
            <h5 class="subscribe-title px-3 mb-4">TERTARIK UNTUK MENDAFTAR ?</h5>
            <h1 class="text-white mb-5">Lihat Informasi Penerimaan Siswa Siswi Baru Tahun Ajaran {{ date('Y') }}</h1>
            <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5"
                href="{{ route('guest_pendaftaran') }}">Selengkapnya</a>
        </div>
    </div>
</div>
