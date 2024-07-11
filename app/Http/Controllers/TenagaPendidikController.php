<?php

namespace App\Http\Controllers;

use App\Models\TenagaPendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenagaPendidikController extends Controller
{
    public function guestIndex()
    {
        return view('guru-staff', [
            'title' => 'Guru & Staff',
            'tenagaPendidik' => TenagaPendidik::all(),
            'jumlahGuru' => TenagaPendidik::where('jabatan', 'Kepala
            Sekolah')->orWhere('jabatan', 'Wakil Kepala Sekolah')
                ->orWhere('jabatan', 'Guru Kelas')->count(),
            'jumlahStaff' => TenagaPendidik::where('jabatan', 'Staff TU')
                ->count(),
        ]);
    }

    public function authIndex()
    {
        return view('admin.guru-staff', [
            'tenagaPendidik' => TenagaPendidik::all(),
        ]);
    }

    public function authCreate()
    {
        return view('admin.guru-staff-create');
    }

    public function authStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'ttg' => 'required',
            'masa_pengabdian' => 'required',
            'alamat' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg',
        ]);

        $foto = $request->file('foto')->store('img');
        TenagaPendidik::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'ttg' => $request->ttg,
            'masa_pengabdian' => $request->masa_pengabdian,
            'alamat' => $request->alamat,
            'foto' => $foto
        ]);

        return redirect()->route('auth_guru_staff')->with(
            'success',
            'Data berhasil ditambahkan.'
        );
    }

    public function authEdit($id)
    {
        return view('admin.guru-staff-create', [
            'tenagaPendidik' => TenagaPendidik::find($id),
        ]);
    }

    public function authUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'ttg' => 'required',
            'masa_pengabdian' => 'required',
            'alamat' => 'required',
            'foto' => 'mimes:png,jpg,jpeg',
        ]);

        $data = TenagaPendidik::find($id);
        $foto = $data->foto;

        if ($request->has('foto')) {
            Storage::delete($data->foto);
            $foto = $request->file('foto')->store('img');
        }

        $data->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'ttg' => $request->ttg,
            'masa_pengabdian' => $request->masa_pengabdian,
            'alamat' => $request->alamat,
            'foto' => $foto
        ]);

        return redirect()->route('auth_guru_staff')
            ->with('success', 'Data berhasil diupdate.');
    }

    public function authDestroy($id)
    {
        $data = TenagaPendidik::findOrFail($id);
        Storage::delete($data->foto);
        $data->delete();

        return redirect()->route('auth_guru_staff')
            ->with('success', 'Data berhasil dihapus.');
    }
}
