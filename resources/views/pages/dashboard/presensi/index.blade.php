<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Presensi</h3>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning">
                Pilih Mesin terlebih dahulu !!
            </div>
            <form action=""
                method="GET">
                <div class="mb-3">
                    <label class="form-label">Mesin</label>
                    <select name="mesinkey"
                        class="form-control custom-select"
                        onchange="this.form.submit()">
                        <option value=""
                            selected>-- Mesin --</option>
                        @foreach ($mesin as $mes)
                            @if (auth()->user()->lokasi_id == $mes->lokasi_id)
                                <option value="{{ $mes->id }}"
                                    {{ @$_GET['mesinkey'] == $mes->id ? 'selected' : '' }}>
                                    {{ $mes->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('mesin')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
            <form action="{{ route('presensi.store') }}"
                method="POST">
                @csrf
                <input type="hidden"
                    name="mesin"
                    value="{{ @$_GET['mesinkey'] }}">
                @if (@$_GET['mesinkey'])
                    <div class="mb-3">
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
                        </div>
                        @error('lineproduksi')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">Shift</label>
                    <select name="shift"
                        class="form-control custom-select">
                        <option value=""
                            selected>-- Shift --</option>
                        @foreach ($shift as $sht)
                            <option value="{{ $sht->id }}"
                                {{ @$_GET['shift'] == $sht->id ? 'selected' : '' }}>
                                {{ $sht->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('shift')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit"
                    class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-admin-layout>
