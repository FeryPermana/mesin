<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $method == 'update' ? 'Update Sparepart' : 'Tambah Sparepart' }}</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('mesin.index') }}"
                            class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <form action=""
                method="GET">
                <div class="mb-3">
                    <label for="mesinkey"
                        class="form-label">Mesin</label>
                    <select name="mesinkey"
                        required
                        id="mesin"
                        class="form-control @error('mesin') border-danger @enderror"
                        onchange="this.form.submit()">
                        <option value=""
                            selected
                            disabled>-- Pilih Mesin --</option>
                        @foreach ($mesin as $m)
                            @if (auth()->user()->lokasi_id == $m->lokasi_id)
                                <option value="{{ $m->id }}"
                                    {{ @$_GET['mesinkey'] || @$sparepart->mesin_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('mesin')
                        <div id="mesin"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
            <form action="{{ $url }}"
                method="POST">
                @csrf
                @if ($method == 'update')
                    @method('PUT')
                @endif
                <input type="hidden"
                    name="mesin"
                    value="{{ @$_GET['mesinkey'] }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="shift"
                                class="form-label">Shift</label>
                            <select name="shift"
                                id="shift"
                                class="form-control @error('shift') border-danger @enderror">
                                <option value=""
                                    selected
                                    disabled>-- Pilih Shift --</option>
                                @foreach ($shift as $s)
                                    <option value="{{ $s->id }}"
                                        {{ old('shift') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                            @error('shift')
                                <div id="shift"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_keluar"
                                class="form-label">Tanggal Update Keluar</label>
                            <input type="date"
                                name="tanggal_keluar"
                                class="form-control @error('tanggal_keluar') border-danger @enderror"
                                id="tanggal_keluar"
                                value="{{ old('tanggal_keluar', @$sparepart->tanggal_keluar) }}">
                            @error('tanggal_keluar')
                                <div id="tanggal_keluar"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lineproduksi"
                                class="form-label">Alokasi Line <span class="text-danger">*</span></label>
                            <select name="lineproduksi"
                                id="lineproduksi"
                                class="form-control @error('lineproduksi') border-danger @enderror">
                                <option value=""
                                    selected>-- Pilih Line Produksi --</option>
                                @foreach ($lineproduksi as $lp)
                                    <option value="{{ $lp->id }}"
                                        {{ @$sparepart->lineproduksi_id == $lp->id ? 'selected' : '' }}>
                                        {{ $lp->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lineproduksi')
                                <div id="lineproduksi"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="shift_id"
                                class="form-label">Shift <span class="text-danger">*</span></label>
                            <select name="shift_id"
                                id="shift_id"
                                class="form-control @error('shift_id') border-danger @enderror">
                                <option value=""
                                    selected>-- Pilih Line Produksi --</option>
                                @foreach ($shift as $st)
                                    <option value="{{ $st->id }}"
                                        {{ @$sparepart->shift_id == $st->id ? 'selected' : '' }}>
                                        {{ $st->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift_id')
                                <div id="shift_id"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="keterangan"
                                class="form-label">Keterangan</label>
                            <textarea name="keterangan"
                                class="form-control @error('keterangan') border-danger @enderror"
                                id="keterangan">{{ old('keterangan', @$sparepart->keterangan) }}</textarea>
                            @error('keterangan')
                                <div id="keterangan"
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
