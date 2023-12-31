<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $method == 'update' ? 'Ubah Jam Kerja' : 'Tambah Jam Kerja' }}</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('jamkerja.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ $url }}" method="POST">
                @csrf
                @if ($method == 'update')
                @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Jam Kerja</label>
                    <input type="text" name="name" class="form-control @error('name') border-danger @enderror" id="name" value="{{ old('name', @$shift->name) }}">
                    @error('name')
                    <div id="name" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-admin-layout>