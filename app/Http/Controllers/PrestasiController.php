<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function guestIndex()
    {
        return view('prestasi', [
            'title' => 'Prestasi',
            'description' => 'TK Dharma Mulya telah berhasil mencetak sejumlah prestasi sampai ditingkaat kabupaten. Kami berkomitmen untuk terus memberikan dukungan dan bimbingan agar setiap anak dapat mencapai potensi penuh mereka.',
            'prestasi' => Prestasi::all(),
        ]);
    }

    public function authIndex()
    {
        return view('admin.prestasi', [
            'prestasi' => Prestasi::all(),
        ]);
    }

    public function authCreate()
    {
        return view('admin.prestasi-create');
    }

    public function authStore(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'juara' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg'
        ]);

        $foto = $request->file('foto')->store('img');
        Prestasi::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'juara' => $request->juara,
            'foto' => $foto,
        ]);

        return redirect()->route('auth_prestasi')
            ->with('success', 'Data prestasi berhasil ditambahkan');
    }

    public function authEdit(Prestasi $data)
    {
        return view('admin.prestasi-create', [
            'prestasi' => $data,
        ]);
    }

    public function authUpdate(Prestasi $data, Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'juara' => 'required',
            'foto' => 'mimes:png,jpg,jpeg'
        ]);

        $foto = $data->foto;
        if ($request->has('foto')) {
            Storage::delete($data->foto);
            $foto = $request->file('foto')->store('img');
        }

        $data->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'juara' => $request->juara,
            'foto' => $foto,
        ]);

        return redirect()->route('auth_prestasi')
            ->with('success', 'Data prestasi berhasil diupdate');
    }

    public function authDestroy(Prestasi $data)
    {
        Storage::delete($data->foto);
        $data->delete();

        return redirect()->route('auth_prestasi')->with('success', 'Data prestasi berhasil dihapus.');
    }
}
