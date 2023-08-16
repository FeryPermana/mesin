<x-admin-layout>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>{{ $method == 'update' ? 'Ubah Jenis Kegiatan' : 'Tambah Jenis Kegiatan' }}</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('jenis-kegiatan.index') }}"
                        class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ $url }}"
                method="POST">
                @csrf
                @if ($method == 'update')
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name"
                        class="form-label">Jenis Kegiatan</label>
                    <input type="text"
                        name="name"
                        class="form-control @error('name') border-danger @enderror"
                        id="name"
                        value="{{ old('name', @$jeniskegiatan->name) }}">
                    @error('name')
                        <div id="name"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="standart"
                        class="form-label">Standart</label>
                    <input type="text"
                        name="standart"
                        class="form-control @error('standart') border-danger @enderror"
                        id="standart"
                        value="{{ old('standart', @$jeniskegiatan->standart) }}">
                    @error('standart')
                        <div id="standart"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit"
                    class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-admin-layout>
