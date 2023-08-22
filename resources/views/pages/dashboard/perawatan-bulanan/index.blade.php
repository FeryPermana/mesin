<x-admin-layout>
    @push('styles')
        <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Perawatan Bulanan</h3>
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
            </form>
            <form action="{{ route('perawatan-bulanan.store') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="hidden"
                        name="mesin"
                        value="{{ @$_GET['mesinkey'] }}">
                    <label for="tanggal"
                        class="form-label">Tanggal Now</label>
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
                                {{ old('lineproduksi') == $l->id ? 'selected' : '' }}>{{ $l->name }}</option>
                        @endforeach
                    </select>
                    @error('lineproduksi')
                        <div id="lineproduksi"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-8">
                            <label class="form-label">Jenis Kegiatan</label>
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                            id="selectAll"
                                            type="checkbox">
                                    </td>
                                    <td>Centang Semua</td>
                                    <td></td>
                                </tr>
                                @foreach ($jeniskegiatan as $jk)
                                    <tr>
                                        <td><input type="checkbox"
                                                name="jenis_kegiatan[]"
                                                value="{{ $jk->id }}"></td>
                                        <td>{{ $jk->name }}</td>
                                        <td>{{ $jk->standart }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Gambar Mesin
                                    <br>
                                    <small class="text-muted fw-normal">Valid File: jpg, jpeg, png | Max Size:
                                        5MB</small>
                                </label>
                                <input type="file"
                                    name="gambar"
                                    class="dropify"
                                    data-default-file="file">
                                @error('gambar')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning text-center">
                Harus memilih semua indikator terlebih dahulu
            </div>
            <form action="">
                <input type="hidden"
                    name="mesinkey"
                    value="{{ @$_GET['mesinkey'] }}">
                <div class="row">
                    <div class="col-md-3">
                        <select name="mesin"
                            class="form-control custom-select">
                            <option value=""
                                selected>-- Mesin --</option>
                            @foreach ($mesin as $mes)
                                @if (auth()->user()->lokasi_id == $mes->lokasi_id)
                                    <option value="{{ $mes->id }}"
                                        {{ @$_GET['mesin'] == $mes->id ? 'selected' : '' }}>
                                        {{ $mes->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
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
                    </div>
                    <div class="col-md-3">
                        <select name="lineproduksi"
                            class="form-control custom-select">
                            <option value=""
                                selected>-- Line Produksi --</option>
                            @foreach ($lineproduksi as $lps)
                                <option value="{{ $lps->id }}"
                                    {{ @$_GET['lineproduksi'] == $lps->id ? 'selected' : '' }}>
                                    {{ $lps->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit"
                            class="btn btn-primary">Filter</button>
                        <a href="{{ route('perawatan.index') }}"
                            class="btn btn-warning">Reset</a>
                    </div>
                </div>
            </form>
            <br>
            @if (@$_GET['mesin'] && @$_GET['lineproduksi'] && @$_GET['shift'])
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">
                                <div style="width: 250px;">
                                    Jenis Kegiatan
                                </div>
                            </th>
                            <th rowspan="2">
                                <div>
                                    Standart
                                </div>
                            </th>
                            <th colspan="31"
                                class="text-center">Pelaksanaan</th>
                        </tr>
                        <tr>
                            @for ($i = 1; $i < 2; $i++)
                                <th>{{ $i }}</th>
                            @endfor
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($jeniskegiatan as $j)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $j->name }}</td>
                                <td>{{ $j->standart }}</td>
                                @foreach ($pengerjaan as $p)
                                    @php
                                        $checklists = $p->checklistbulanan;
                                        
                                        $arraycheck = [];
                                        foreach ($checklists as $checklist) {
                                            $arraycheck[] = $checklist->is_check ? $checklist->jenis_kegiatan_id : 0;
                                        }
                                    @endphp
                                    @if (in_array($j->id, $arraycheck))
                                        <td><i class="ti ti-check"></i></td>
                                    @else
                                        <td>-</td>
                                    @endif
                                @endforeach
                                @php
                                    $p = 2 - count($pengerjaan);
                                @endphp
                                @for ($i = 1; $i < $p; $i++)
                                    <td>-</td>
                                @endfor
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="alert alert-danger">
                    <div class="text-center">
                        Data belum ada silhakan pilih indikator lain
                    </div>
                </div>
            @endif

        </div>
    </div>

    @push('scripts')
        <script>
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });
        </script>
    @endpush
</x-admin-layout>
