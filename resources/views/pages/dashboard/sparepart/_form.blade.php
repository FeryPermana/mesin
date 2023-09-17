<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $method == 'update' ? 'Ubah Sparepart' : 'Tambah Sparepart' }}</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('mesin.index') }}"
                            class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ $url }}"
                method="POST">
                @csrf
                @if ($method == 'update')
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="item"
                                class="form-label">Item Spare Part</label>
                            <input type="text"
                                name="item"
                                class="form-control @error('item') border-danger @enderror"
                                id="item"
                                value="{{ old('item', @$sparepart->item) }}">
                            @error('item')
                                <div id="item"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kode_barang"
                                class="form-label">Kode Barang</label>
                            <input type="text"
                                name="kode_barang"
                                class="form-control @error('kode_barang') border-danger @enderror"
                                id="kode_barang"
                                value="{{ old('kode_barang', @$sparepart->kode_barang) }}">
                            @error('kode_barang')
                                <div id="kode_barang"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock"
                                class="form-label">Stock Update</label>
                            <input type="number"
                                name="stock"
                                class="form-control @error('stock') border-danger @enderror"
                                id="stock"
                                value="{{ old('stock', @$sparepart->stock) }}">
                            @error('stock')
                                <div id="stock"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_masuk"
                                class="form-label">Tanggal Update Masuk</label>
                            <input type="date"
                                name="tanggal_masuk"
                                class="form-control @error('tanggal_masuk') border-danger @enderror"
                                id="tanggal_masuk"
                                value="{{ old('tanggal_masuk', @$sparepart->tanggal_masuk) }}">
                            @error('tanggal_masuk')
                                <div id="tanggal_masuk"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });
            $("#selectLine").click(function() {
                $("#checkline input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });
        </script>
    @endpush
</x-admin-layout>
