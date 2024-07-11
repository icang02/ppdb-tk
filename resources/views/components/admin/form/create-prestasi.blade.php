@php
    if (Route::is('auth_prestasi_create')) {
        $route = route('auth_prestasi_store');
    } else {
        $route = route('auth_prestasi_update', $prestasi->id);
    }
@endphp

<form action="{{ $route }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (Route::is('auth_prestasi_create'))
        @method('post')
    @else
        @method('put')
    @endif
    <div class="row g-3">
        <div class="col-lg-6">
            <div>
                <label for="nama_kegiatan" class="form-label">nama kegiatan</label>
                <input value="{{ old('nama_kegiatan', $prestasi->nama_kegiatan ?? null) }}" name="nama_kegiatan"
                    type="text" class="form-control" id="nama_kegiatan" />
            </div>
            @error('nama_kegiatan')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-6">
            <div class="mb-1">
                <label for="foto" class="form-label">Foto</label>
                <input accept=".png,.jpg,.jpeg" name="foto" type="file" class="form-control" id="foto"
                    placeholder="Foto" />
            </div>
            <small class="d-block">Format file : png, jpg, jpeg</small>
            @error('foto')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-6">
            <div>
                <label for="juara" class="form-label">Juara</label>
                <input value="{{ old('juara', $prestasi->juara ?? null) }}" name="juara" type="text"
                    class="form-control" id="juara" />
            </div>
            @error('juara')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">
                {{ Route::is('auth_prestasi_create') ? 'Tambah' : 'Update' }}
            </button>
        </div>
    </div>
</form>
