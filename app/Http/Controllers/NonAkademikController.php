<?php

namespace App\Http\Controllers;

use App\Models\NonAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class NonAkademikController extends Controller
{
    public function guestIndex()
    {
        return view('non-akademik', [
            'title' => 'Non Akademik',
            'description' => 'keberagaman dan keceriaan di TK Dharma Mulya
            disalurkan melalui berbagai kegiatan ekstrakurikuler / event.
            Setiap siswa diundang untuk mengeksplorasi minat dan bakat melalui
            kegiatan untuk memperkaya pengalaman belajar mereka.',
            'nonAkademik' => NonAkademik::all(),
        ]);
    }

    public function authIndex()
    {
        return view('admin.non-akademik', [
            'nonAkademik' => NonAkademik::all(),
        ]);
    }

    public function authCreate()
    {
        return view('admin.non-akademik-create');
    }

    public function authStore(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg'
        ]);

        $foto = $request->file('foto')->store('img');
        NonAkademik::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
        ]);

        return redirect()->route('auth_non_akademik')
            ->with('success', 'Data kegiatan non akademik
            berhasil ditambahkan');
    }

    public function authEdit(NonAkademik $data)
    {
        return view('admin.non-akademik-create', [
            'nonAkademik' => $data,
        ]);
    }

    public function authUpdate(NonAkademik $data, Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'mimes:png,jpg,jpeg'
        ]);

        $foto = $data->foto;
        if ($request->has('foto')) {
            Storage::delete($data->foto);
            $foto = $request->file('foto')->store('img');
        }

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
        ]);

        return redirect()->route('auth_non_akademik')
            ->with('success', 'Data kegiatan non
        akademik berhasil diupdate');
    }

    public function authDestroy(NonAkademik $data)
    {
        Storage::delete($data->foto);
        $data->delete();

        return redirect()->route('auth_non_akademik')
            ->with('success', 'Data kegiatan non akademik
            berhasil dihapus.');
    }
}
