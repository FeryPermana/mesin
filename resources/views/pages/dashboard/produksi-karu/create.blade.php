<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Produksi</h3>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning">
                Pilih Mesin terlebih dahulu !!
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
                                    {{ @$_GET['mesinkey'] == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('mesin')
                        <div id="mesin"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="shiftkey"
                                class="form-label">Shift <span class="text-danger">*</span></label>
                            <select name="shiftkey"
                                id="shiftkey"
                                class="form-control @error('shift') border-danger @enderror"
                                onchange="this.form.submit()">
                                <option value=""
                                    disabled
                                    selected>-- Pilih Shift --</option>
                                @foreach ($shift as $s)
                                    <option value="{{ $s->id }}"
                                        {{ @$_GET['shiftkey'] == $s->id ? 'selected' : '' }}>{{ $s->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift')
                                <div id="shift"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
            </form>
            <form action="{{ route('produksi-karu.store') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden"
                    name="mesin"
                    value="{{ @$_GET['mesinkey'] }}">
                <input type="hidden"
                    name="shift"
                    value="{{ @$_GET['shiftkey'] }}">
        </div>
        <label class="form-label">Line Produksi</label>
        <div class="row"
            id="checkline">
            @foreach ($lineproduksi as $lp)
                <div class="col-6 mb-2">
                    <input type="radio"
                        name="lineproduksi"
                        value="{{ $lp->id }}">
                    &nbsp;&nbsp;{{ $lp->name }}
                </div>
            @endforeach
            @error('lineproduksi')
                <div id="lineproduksi"
                    class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="tanggal"
                class="form-label">Tanggal <span class="text-danger">*</span></label>
            <input type="date"
                class="form-control @error('tanggal') border-danger @enderror"
                name="tanggal">
            @error('tanggal')
                <div id="downtime"
                    class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="my-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jam Kerja</th>
                        <th>Pallet</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jamkerja as $jk)
                        <tr>
                            <td>{{ $jk->name }}</td>
                            <td>
                                <input type="number"
                                    class="form-control"
                                    name="pallet[]"
                                    id="pallet{{ $jk->id }}"
                                    onchange="jumlah({{ $jk->id }})"
                                    required>
                            </td>
                            <td>
                                <div id="jumlah{{ $jk->id }}">

                                </div>
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control"
                                    name="keterangan[]"
                                    id="keterangan{{ $jk->id }}"
                                    required>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
            function jumlah(id) {
                var pallet = $('#pallet' + id).val();
                var jumlah = pallet * 144;
                $('#jumlah' + id).text(jumlah);
            }
        </script>
    @endpush
</x-admin-layout>
