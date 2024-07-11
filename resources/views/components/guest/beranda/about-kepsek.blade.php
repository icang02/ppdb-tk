<div class="container-fluid about py-5" id="kepsek">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                    <img src="{{ asset('storage/' . $kepsek->foto) }}" class="img-fluid w-100 h-100" alt="">
                </div>
            </div>
            <div class="col-lg-7"
                style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                <h5 class="section-about-title pe-3">{{ $kepsek->jabatan }}</h5>
                <h1 class="mb-4">{{ $kepsek->nama }}</h1>
                <p class="mb-4">
                    Dengan bangga menyambut Anda di lingkungan pendidikan kami yang penuh
                    dengan keceriaan dan pembelajaran. Di TK Dharma Mulya, kami berkomitmen untuk menyediakan
                    lingkungan belajar yang aman, menyenangkan, dan edukatif bagi para peserta didik kami.
                </p>
                <p class="mb-4">
                    Mari bersama-sama mendukung tumbuh kembang anak-anak kita agar mereka dapat tumbuh menjadi
                    individu yang percaya diri, kreatif, dan memiliki nilai-nilai luhur. Terima kasih telah menjadi
                    bagian dari TK Dharma Mulya.
                </p>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="#visi-misi">
                    Visi & Misi <span class="fa fa-arrow-down text-white ms-1">
                </a>
            </div>
        </div>
    </div>
</div>
