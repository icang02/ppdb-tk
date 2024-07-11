<?php

namespace App\Http\Controllers;

use App\Models\FotoTemaBelajar;
use App\Models\TemaBelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TemaBelajarController extends Controller
{
    public function authIndex()
    {
        return view('admin.tema-belajar', [
            'tema' => TemaBelajar::all()
        ]);
    }

    public function authEdit(TemaBelajar $data)
    {
        return view('admin.tema-belajar-edit', [
            'tema' => $data,
        ]);
    }

    public function authStore(Request $request)
    {
        $request->validate([
            'nama_tema' => 'required|unique:tema_belajar,nama_tema'
        ]);

        TemaBelajar::create([
            'nama_tema' => str()->title($request->nama_tema)
        ]);

        return redirect()->route('auth_tema_belajar')
            ->with('success', 'Data tema belajar
                            berhasil ditambahkan.');
    }

    public function authUpdate(Request $request, TemaBelajar $data)
    {
        if ($request->nama_tema == $data->nama_tema) {
            $validasi = 'required';
        } else {
            $validasi = 'required|unique:tema_belajar,nama_tema';
        }

        $request->validate(['nama_tema' => $validasi]);

        $data->update([
            'nama_tema' => str()->title($request->nama_tema)
        ]);

        if ($request->has('foto')) {
            $validator = Validator::make($request->all(), [
                'foto.*' => 'mimes:jpeg,png,jpg'
            ]);

            if ($validator->fails())
                return redirect()->back()
                    ->withErrors($validator)->withInput();

            foreach ($request->file('foto') as $item) {
                $foto = $item->store('img');
                FotoTemaBelajar::create([
                    'tema_belajar_id' => $data->id,
                    'foto' => $foto
                ]);
            }
        }

        return redirect()->route(
            'auth_tema_belajar_edit',
            $data->id
        )->with('success', 'Data tema belajar
                        berhasil diupdate.');
    }

    public function authDestroy(TemaBelajar $data)
    {
        $foto = $data->fotoTemaBelajar;
        if ($foto->count() != 0) {
            foreach ($foto as $item) {
                Storage::delete($item->foto);
            }
        }

        $data->delete();

        return redirect()->route('auth_tema_belajar')->with('success', 'Data tema belajar berhasil dihapus.');
    }

    public function authDestroyFoto(FotoTemaBelajar $data)
    {
        Storage::delete($data->foto);
        $data->delete();
        return redirect()->back()->with(
            'success',
            'Foto berhasil dihapus.'
        );
    }
}
