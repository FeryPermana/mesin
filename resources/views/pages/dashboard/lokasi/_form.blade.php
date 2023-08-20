<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $method == 'update' ? 'Ubah Jam Kerja' : 'Tambah Jam Kerja' }}</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('lokasi.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ $url }}" method="POST">
                @csrf
                @if ($method == 'update')
                @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control @error('lokasi') border-danger @enderror" id="lokasi" value="{{ old('lokasi', @$lokasi->lokasi) }}">
                    @error('lokasi')
                    <div id="lokasi" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-admin-layout>