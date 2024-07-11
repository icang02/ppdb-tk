@php
    if (Route::is('auth_guru_staff_create')) {
        $route = route('auth_guru_staff_store');
    } else {
        $route = route('auth_guru_staff_update', $tenagaPendidik->id);
    }
@endphp

<form action="{{ $route }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (Route::is('auth_guru_staff_create'))
        @method('post')
    @else
        @method('put')
    @endif
    <div class="row g-3">
        <div class="col-lg-6">
            <div>
                <label for="nama" class="form-label">Nama</label>
                <input value="{{ old('nama', $tenagaPendidik->nama ?? null) }}" name="nama" type="text"
                    class="form-control" id="nama" placeholder="Ayu Mulyani" />
            </div>
            @error('nama')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-6">
            <div>
                <label for="jabatan" class="form-label">Jabatan</label>
                <select class="form-select" id="jabatan" name="jabatan">
                    <option value="">Pilih jabatan</option>
                    <option @if (old('jabatan', $tenagaPendidik->jabatan ?? null) == 'Kepala Sekolah') selected @endif value="Kepala Sekolah">Kepala
                        Sekolah</option>
                    <option @if (old('jabatan', $tenagaPendidik->jabatan ?? null) == 'Wakil Kepala Sekolah') selected @endif value="Wakil Kepala Sekolah">Wakil
                        Kepala Sekolah</option>
                    <option @if (old('jabatan', $tenagaPendidik->jabatan ?? null) == 'Guru Kelas') selected @endif value="Guru Kelas">Guru Kelas
                    </option>
                    <option @if (old('jabatan', $tenagaPendidik->jabatan ?? null) == 'Staff TU') selected @endif value="Staff TU">Staff TU</option>
                </select>
            </div>
            @error('jabatan')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-6">
            <div>
                <label for="ttg" class="form-label">Tempat, Tanggal Lahir</label>
                <input value="{{ old('ttg', $tenagaPendidik->ttg ?? null) }}" name="ttg" type="text"
                    class="form-control" id="ttg" placeholder="Baito, 1 Januari {{ date('Y') }}" />
            </div>
            @error('ttg')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-6">
            <div>
                <label for="masa_pengabdian" class="form-label">Masa Pengabdian</label>
                <input value="{{ old('masa_pengabdian', $tenagaPendidik->masa_pengabdian ?? null) }}"
                    name="masa_pengabdian" type="text" class="form-control" id="masa_pengabdian"
                    placeholder="Masa pengabdian" />
            </div>
            @error('masa_pengabdian')
                <small class="mt-1 text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-lg-6">
            <div>
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3"
                    placeholder="Baito, Kabupaten Konawe Selatan">{{ old('alamat', $tenagaPendidik->alamat ?? null) }}</textarea>
            </div>
            @error('alamat')
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
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">
                {{ Route::is('auth_guru_staff_create') ? 'Tambah' : 'Update' }}
            </button>
        </div>
    </div>
</form>
