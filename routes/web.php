<?php

use App\Http\Controllers\AkademikController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NonAkademikController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\TemaBelajarController;
use App\Http\Controllers\TenagaPendidikController;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Route;
// use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Artisan;

Route::get('/seed', function () {
    return  Artisan::call('migrate:fresh --seed');
});
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/guru-staff', [TenagaPendidikController::class, 'guestIndex'])->name('guest_guru_staff');
Route::get('/akademik', [AkademikController::class, 'guestIndex'])->name('guest_akademik');
Route::get('/non-akademik', [NonAkademikController::class, 'guestIndex'])->name('guest_non_akademik');
Route::get('/prestasi', [PrestasiController::class, 'guestIndex'])->name('guest_prestasi');
Route::get('/pendaftaran', [PendaftaranController::class, 'guestIndex'])->name('guest_pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'guestSubmitPendaftaran'])->name('guest_submit_pendaftaran');
Route::post('/cek-kelulusan', [PendaftaranController::class, 'guestCekKelulusan'])->name('guest_cek_kelulusan');
Route::post('/unggah-pembayaran', [PendaftaranController::class, 'guestUnggahPembayaran'])->name('guest_unggah_pembayaran');
Route::get('/download-formulir', [PendaftaranController::class, 'downloadFormulir'])->name('download_formulir');

Route::get('/login', [AuthController::class, 'indexLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth_login')->middleware('guest');


Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => 'can:admin'], function () {
        Route::get('/dashboard/guru-staff', [TenagaPendidikController::class, 'authIndex'])->name('auth_guru_staff');
        Route::get('/dashboard/guru-staff/create', [TenagaPendidikController::class, 'authCreate'])->name('auth_guru_staff_create');
        Route::post('/dashboard/guru-staff/store', [TenagaPendidikController::class, 'authStore'])->name('auth_guru_staff_store');
        Route::get('/dashboard/guru-staff/edit/{id}', [TenagaPendidikController::class, 'authEdit'])->name('auth_guru_staff_edit');
        Route::put('/dashboard/guru-staff/update/{id}', [TenagaPendidikController::class, 'authUpdate'])->name('auth_guru_staff_update');
        Route::get('/dashboard/guru-staff/destroy/{id}', [TenagaPendidikController::class, 'authDestroy'])->name('auth_guru_staff_destroy');

        Route::get('/dashboard/data-pendaftar/destroy/{id}', [PendaftaranController::class, 'authDestroy'])->name('auth_pendaftaran_destroy');
        Route::get('/dashboard/tanggal-pendaftaran', [PendaftaranController::class, 'authTanggal'])->name('auth_tanggal_pendaftaran');
        Route::put('/dashboard/tanggal-pendaftaran/{id}', [PendaftaranController::class, 'authUpdate'])->name('auth_tanggal_pendaftaran_update');
        Route::put('/dashboard/verifikasi-kelulusan/{id}', [PendaftaranController::class, 'authVerifikasi'])->name('auth_verifikasi_pendaftaran');
        Route::put('/dashboard/keterangan-kelulusan/{id}', [PendaftaranController::class, 'authKeterangan'])->name('auth_keterangan_pendaftaran');


        Route::get('/dashboard/non-akademik', [NonAkademikController::class, 'authIndex'])->name('auth_non_akademik');
        Route::get('/dashboard/non-akademik/create', [NonAkademikController::class, 'authCreate'])->name('auth_non_akademik_create');
        Route::post('/dashboard/non-akademik/store', [NonAkademikController::class, 'authStore'])->name('auth_non_akademik_store');
        Route::get('/dashboard/non-akademik/edit/{data}', [NonAkademikController::class, 'authEdit'])->name('auth_non_akademik_edit');
        Route::put('/dashboard/non-akademik/update/{data}', [NonAkademikController::class, 'authUpdate'])->name('auth_non_akademik_update');
        Route::get('/dashboard/non-akademik/destroy/{data}', [NonAkademikController::class, 'authDestroy'])->name('auth_non_akademik_destroy');

        Route::get('/dashboard/prestasi', [PrestasiController::class, 'authIndex'])->name('auth_prestasi');
        Route::get('/dashboard/prestasi/create', [PrestasiController::class, 'authCreate'])->name('auth_prestasi_create');
        Route::post('/dashboard/prestasi/store', [PrestasiController::class, 'authStore'])->name('auth_prestasi_store');
        Route::get('/dashboard/prestasi/edit/{data}', [PrestasiController::class, 'authEdit'])->name('auth_prestasi_edit');
        Route::put('/dashboard/prestasi/update/{data}', [PrestasiController::class, 'authUpdate'])->name('auth_prestasi_update');
        Route::get('/dashboard/prestasi/destroy/{data}', [PrestasiController::class, 'authDestroy'])->name('auth_prestasi_destroy');

        Route::get('/dashboard/akademik', [TemaBelajarController::class, 'authIndex'])->name('auth_tema_belajar');
        Route::get('/dashboard/akademik/edit/{data}', [TemaBelajarController::class, 'authEdit'])->name('auth_tema_belajar_edit');
        Route::post('/dashboard/tema-belajar/store', [TemaBelajarController::class, 'authStore'])->name('auth_tema_belajar_store');
        Route::put('/dashboard/tema-belajar/update/{data}', [TemaBelajarController::class, 'authUpdate'])->name('auth_tema_belajar_update');
        Route::get('/dashboard/tema-belajar/destroy/{data}', [TemaBelajarController::class, 'authDestroy'])->name('auth_tema_belajar_destroy');

        Route::get('/dashboard/tema-belajar/foto/destroy/{data}', [TemaBelajarController::class, 'authDestroyFoto'])->name('auth_tema_belajar_destroy_foto');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data-pendaftar', [PendaftaranController::class, 'authIndex'])->name('auth_pendaftaran');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'can:kepsek'], function () {
        Route::post('/dashboard/verifikasi-data', [PendaftaranController::class, 'authVerifikasiData'])->name('auth_verifikasi_data');
        Route::get('/dashboard/laporan-pembayaran', [PendaftaranController::class, 'lap_pembayaran'])->name('index_laporan_pembayaran');

        Route::get('/cetak-laporan-pembayaran', function () {
            $data = [
                'pendaftar' => Pendaftaran::orderBy('nama')->get(),
                'pembayaran' => 1,
            ];

            Pdf::setOption(['dpi' => 150, 'defaultFont' => 'Arial']);
            $pdf = Pdf::loadView('cetak', $data)->setPaper('a4', 'portrait')->setWarnings(false);
            return $pdf->stream('Laporan Hasil Seleksi Peserta Didik Baru TK Dharma Mulya Periode ' . date('Y') . '-' . date('Y') + 1 . '.pdf');
        })->name('cetak_lap_pembayaran');
    });

    Route::get('/cetak', function () {
        $data = [
            'pendaftar' => Pendaftaran::orderBy('nama')->get()
        ];

        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'Arial']);
        $pdf = Pdf::loadView('cetak', $data)->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->stream('Laporan Hasil Seleksi Peserta Didik Baru TK Dharma Mulya Periode ' . date('Y') . '-' . date('Y') + 1 . '.pdf');
    })->name('cetak');
});
