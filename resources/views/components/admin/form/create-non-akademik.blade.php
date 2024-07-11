@php
    if (Route::is('auth_non_akademik_create')) {
        $route = route('auth_non_akademik_store');
    } else {
        $route = route('auth_non_akademik_update', $nonAkademik->id);
    }
@endphp

<form action="{{ $route }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (Route::is('auth_non_akademik_create'))
        @method('post')
    @else
        @method('put')
    @endif
    <div class="row g-3">
        <div class="col-lg-6">
            <div>
                <label for="judul" class="form-label">judul</label>
                <input value="{{ old('judul', $nonAkademik->judul ?? null) }}" name="judul" type="text"
                    class="form-control" id="judul" placeholder="Ayu Mulyani" />
            </div>
            @error('judul')
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
                <label for="deskripsi" class="form-label">deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"
                    placeholder="Baito, Kabupaten Konawe Selatan">{{ old('deskripsi', $nonAkademik->deskripsi ?? null) }}</textarea>
            </div>
            @error('deskripsi')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">
                {{ Route::is('auth_non_akademik_create') ? 'Tambah' : 'Update' }}
            </button>
        </div>
    </div>
</form>
