<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Monitoring Suhu</h3>
                    </div>
                </div>
            </div>
            <br>
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
                            <option value="{{ $m->id }}"
                                {{ @$_GET['mesinkey'] || @$sparepart->mesin_id == $m->id ? 'selected' : '' }}>
                                {{ $m->name }}</option>
                        @endforeach
                    </select>
                    @error('mesin')
                        <div id="mesin"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
            <form action="{{ route('monitoring-suhu.store') }}"
                method="POST">
                @csrf
                <input type="hidden"
                    name="mesin"
                    value="{{ @$_GET['mesinkey'] }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal"
                                class="form-label">Tanggal</label>
                            <input type="date"
                                name="tanggal"
                                class="form-control @error('tanggal') border-danger @enderror"
                                id="tanggal"
                                value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div id="tanggal"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="suhu"
                                class="form-label">Suhu (Celcius)</label>
                            <input type="number"
                                name="suhu"
                                class="form-control @error('suhu') border-danger @enderror"
                                id="suhu"
                                value="{{ old('suhu') }}">
                            @error('suhu')
                                <div id="suhu"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rh"
                                class="form-label">Rh (%)</label>
                            <input type="number"
                                name="rh"
                                class="form-control @error('rh') border-danger @enderror"
                                id="rh"
                                value="{{ old('rh') }}">
                            @error('rh')
                                <div id="rh"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
                            <label for="lineproduksi"
                                class="form-label">Line Produksi</label>
                            <select name="lineproduksi"
                                id="lineproduksi"
                                class="form-control @error('lineproduksi') border-danger @enderror">
                                <option value=""
                                    selected
                                    disabled>-- Pilih Line Produksi --</option>
                                @foreach ($lineproduksi as $l)
                                    <option value="{{ $l->id }}"
                                        {{ old('lineproduksi') == $l->id ? 'selected' : '' }}>{{ $l->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lineproduksi')
                                <div id="lineproduksi"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan"
                                class="form-label">Keterangan</label>
                            <textarea name="keterangan"
                                class="form-control @error('keterangan') border-danger @enderror"
                                id="keterangan"
                                rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div id="tanggal"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="btn btn-primary">Simpan</button>
            </form>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Tanggal</th>
                        <th>Suhu</th>
                        <th>Rh</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        @forelse ($monitoringsuhu as $ms)
                            <tr>
                                <td>{{ $ms->tanggal }}</td>
                                <td>{{ $ms->suhu }}</td>
                                <td>{{ $ms->rh }}</td>
                                <td>{{ $ms->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <div class="alert alert-warning"
                                            role="alert">
                                            Data tidak ada
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
