<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $method == 'update' ? 'Update User' : 'Tambah User' }}</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ $url }}" method="POST">
                @csrf
                @if ($method == 'update')
                @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') border-danger @enderror" id="name" value="{{ old('name', @$user->name) }}">
                    @error('name')
                    <div id="name" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nik" class="form-label">Nik <span class="text-danger">*</span></label>
                    <input type="text" name="nik" class="form-control @error('nik') border-danger @enderror" id="nik" value="{{ old('nik', @$user->nik) }}">
                    @error('nik')
                    <div id="nik" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="form-control @error('role') border-danger @enderror">
                        <option value="" disabled selected>-- Pilih Tingkatan --</option>
                        <option value="2" {{ old('role', @$user->role) == '2' ? 'selected' : '' }}>Kabag</option>
                        <option value="3" {{ old('role', @$user->role) == '3' ? 'selected' : '' }}>Teknisi</option>
                        <option value="4" {{ old('role', @$user->role) == '4' ? 'selected' : '' }}>Kepala Regu</option>
                        <option value="5" {{ old('role', @$user->role) == '5' ? 'selected' : '' }}>Operator</option>
                    </select>
                    @error('role')
                    <div id="role" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <select name="lokasi" id="lokasi" class="form-control @error('lokasi') border-danger @enderror">
                        <option value="" selected>-- Pilih Lokasi --</option>
                        @foreach ($lokasi as $l)
                        <option value="{{ $l->id }}" {{ old('lokasi_id', @$user->lokasi_id) == $l->id ? 'selected' : '' }}>
                            {{ $l->lokasi }}
                        </option>
                        @endforeach
                    </select>
                    @error('lokasi')
                    <div id="lokasi" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password{{ $method == 'update' ? '' : `<span class="text-danger">*</span>` }}
                    </label>
                    <input type="text" name="password" class="form-control @error('password') border-danger @enderror" id="password">
                    @error('password')
                    <div id="password" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-admin-layout>