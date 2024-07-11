<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\StatusPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class PendaftaranController extends Controller
{
    public function guestIndex()
    {
        $dataTanggal = StatusPendaftaran::first();

        $tanggalSelesai = strtotime($dataTanggal->tanggal_selesai);
        $tanggalSekarang = time();


        if ($tanggalSekarang > $tanggalSelesai) {
            $dataTanggal->update(['status' => 'ditutup']);
        }

        return view('pendaftaran', [
            'title' => 'Informasi Pendaftaran',
            'statusPendaftaran' => $dataTanggal,
        ]);
    }

    public function guestSubmitPendaftaran(Request $request)
    {
        Session::flash('submit', 'Submitted.');

        $status = StatusPendaftaran::first();
        if ($status->status == 'belum dibuka')
            return back()->with('error', 'Masa Pendaftaran belum dibuka.')->withInput();
        if ($status->status == 'ditutup')
            return back()->with('error', 'Masa pendaftaran telah berakhir.')->withInput();

        $tahunMin = 5;
        $bulanMin = 5;
        if (intval($request->umurTahun) < $tahunMin && intval($request->umurBulan) < $bulanMin) {
            return back()->with('error', "Usia pendaftar belum mencukupi. Syarat minimal berusia $tahunMin tahun $bulanMin bulan");
        }

        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:pendaftaran,nik',
            'nohp' => 'required',
            'kk' => 'required',
            'ktp' => 'required',
            'formulir' => 'required|mimes:pdf',
            'foto' => 'required|mimes:png,jpg,jpeg',
            'surat_domisili' => 'mimes:pdf',
        ]);

        $pendaftaranBaru = Pendaftaran::create([
            'no_pendaftaran' => "TKDM" . sprintf('%04d', Pendaftaran::max('id') + 1),
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nohp' => $request->nohp,
            'kk' => $request->file('kk')->store('pendaftaran'),
            'ktp' => $request->file('ktp')->store('pendaftaran'),
            'formulir' => $request->file('formulir')->store('pendaftaran'),
            'foto' => $request->file('foto')->store('pendaftaran'),
            'surat_domisili' => $request->has('surat_domisili') ? $request->file('surat_domisili')->store('pendaftaran') : null
        ]);
        Session::flash('no_pendaftaran', $pendaftaranBaru->no_pendaftaran);
        Session::flash('nama', $pendaftaranBaru->nama);
        Session::flash('nik', $pendaftaranBaru->nik);
        Session::flash('nohp', $pendaftaranBaru->nohp);

        return back()->with('success', 'Pendaftaran berhasil.');
    }

    public function authVerifikasi(Request $request, $id)
    {
        $data = Pendaftaran::findOrFail($id);
        $data->update([
            'status_kelulusan' => $request->status_kelulusan,
            'keterangan' => null
        ]);
        return back()->withInput()->with('success', 'Data diperbarui.');
    }

    public function authVerifikasiData(Request $request)
    {
        $data = StatusPendaftaran::find(2);
        $data->update([
            'status' => $request->status_verifikasi,
            'tanggal_pengumuman' => Carbon::now()->format('y-m-d h:i:s')
        ]);

        $pesan = $request->status_verifikasi == 'verifikasi' ? 'Data diverifikasi oleh Kepala Sekolah.' : '.Verifikasi dibatalkan.';

        return back()->withInput()->with('success', $pesan);
    }

    public function lap_pembayaran()
    {
        $data = Pendaftaran::all();
        return view('admin.lap-pembayaran', [
            'dataPendaftar' => $data,
        ]);
    }


    public function authKeterangan(Request $request, $id)
    {
        $data = Pendaftaran::findOrFail($id);
        $data->update([
            'keterangan' => $request->keterangan,
            'status_kelulusan' => 'tidak lulus'
        ]);
        return back()->withInput()->with('success', 'Data diperbarui.');
    }

    public function downloadFormulir()
    {
        return Storage::download('file/PENERIMAAN PESERTA DIDIK BARU.docx');
    }

    public function guestCekKelulusan(Request $request)
    {
        Session::flash('submit', 'Submitted.');

        $data = Pendaftaran::where('nik', $request->nik_cek)->orWhere('no_pendaftaran', $request->nik_cek)->first();

        if ($data != null) {
            $dataTanggal = StatusPendaftaran::first();

            $tanggalPengumuman = strtotime($dataTanggal->tanggal_pengumuman);
            $tanggalSekarang = time();

            if ($dataTanggal->tanggal_pengumuman == null || $tanggalPengumuman > $tanggalSekarang) {
                return back()->with('info', "Silahkan cek secara berkala waktu pengumuman kelulusan.")->withInput();
            } else {
                if ($data->status_kelulusan == 'belum verifikasi')
                    return back()->with('info', "Berkas Anda masih dalam proses verifikasi.")->withInput();
                else if ($data->status_kelulusan == 'lulus')
                    return back()
                        ->with('successLulus', "Selamat <b>$data->nama</b>,
                        seluruh data dan berkas Anda memenuhi persyaratan.
                        Selanjutnya silahkan lakukan pembayaran biaya
                        pendaftaran pada form unggah slip pembayaran di bawah.")->withInput();
                else if ($data->status_kelulusan == 'tidak lulus')
                    return back()
                        ->with('tidakLulus', "Mohon maaf <b>$data->nama</b>, data dan berkas Anda tidak memenuhi persyaratan.<br><hr><i>Keterangan : <span class='fw-bold'>$data->keterangan</span><i/>")->withInput();
            }
        } else {
            return back()->with('info', "No. pendaftaran atau
            NIK yang Anda masukkan tidak ditemukan.")->withInput();
        }
    }

    public function guestUnggahPembayaran(Request $request)
    {
        Session::flash('submit', 'Submitted.');
        $data = Pendaftaran::where('nik', $request->nik)->orWhere('no_pendaftaran', $request->nik)->first();

        // dd($data);

        $slip = $request->file('slip')->store('pendaftaran');
        $data->update(['slip_pembayaran' => $slip]);

        Session::flash('no_pendaftaran', $data->no_pendaftaran);
        Session::flash('nama', $data->nama);
        Session::flash('nik', $data->nik);
        Session::flash('nohp', $data->nohp);

        return back()->withInput()->with(
            'success',
            'Slip pembayaran Anda berhasil diunggah.
            Jika salah mengupload silahkan submit kembali
            slip pembayaran Anda.'
        );
    }

    public function authIndex()
    {
        return view('admin.pendaftaran', [
            'dataPendaftar' => Pendaftaran::all(),
        ]);
    }

    public function authDestroy($id)
    {
        $data = Pendaftaran::findOrFail($id);
        Storage::delete([$data->kk, $data->ktp, $data->formulir, $data->foto]);

        if ($data->slip_pembayaran)
            Storage::delete($data->slip_pembayaran);
        if ($data->surat_domisili)
            Storage::delete($data->surat_domisili);

        $data->delete();

        return back()->with('success', 'Data pendaftaran dihapus.');
    }

    public function authTanggal()
    {
        return view('admin.tanggal-pendaftaran', [
            'data' => StatusPendaftaran::first(),
        ]);
    }

    public function authUpdate(Request $request, $id)
    {
        $tanggalMulai = strtotime($request->tanggal_mulai);
        $tanggalSelesai = strtotime($request->tanggal_selesai);
        $tanggalSekarang = time();

        if ($tanggalMulai > $tanggalSelesai)
            return back()->with('error', 'Tanggal mulai tidak
        boleh melewati tanggal selesai.')->withInput();

        $data = StatusPendaftaran::findOrFail($id);

        if ($tanggalSelesai > $tanggalSekarang)
            $status = 'dibuka';
        else
            $status = 'ditutup';

        $data->update([
            'tanggal_mulai' => date('Y-m-d H:i:s', $tanggalMulai),
            'tanggal_selesai' => date('Y-m-d H:i:s', $tanggalSelesai),
            'tanggal_pengumuman' => $request->tanggal_pengumuman,
            'status' => $status
        ]);

        return back()->with('success', 'Tanggal pendaftaran diupdate.');
    }
}
