<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Input Downtime</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('downtime.create') }}"
                            class="btn btn-primary">Tambah Downtime</a>
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
            <form action="{{ route('teknisi-downtime.store') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden"
                    name="mesin"
                    value="{{ @$_GET['mesinkey'] }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="shift"
                                class="form-label">Shift <span class="text-danger">*</span></label>
                            <select name="shift"
                                id="shift"
                                class="form-control @error('shift') border-danger @enderror">
                                <option value=""
                                    disabled
                                    selected>-- Pilih Shift --</option>
                                @foreach ($shift as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                            @error('shift')
                                <div id="shift"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
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
                        <div class="mb-3">
                            <label for="downtime"
                                class="form-label">Jenis Downtime <span class="text-danger">*</span></label>
                            <select name="downtime"
                                id="downtime"
                                class="form-control @error('downtime') border-danger @enderror">
                                <option value=""
                                    disabled
                                    selected>-- Pilih Downtime --</option>
                                @foreach ($jenisdowntime as $js)
                                    <option value="{{ $js->id }}">{{ $js->name }}</option>
                                @endforeach
                            </select>
                            @error('downtime')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal"
                                class="form-label">Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local"
                                class="form-control @error('tanggal') border-danger @enderror"
                                name="tanggal">
                            @error('tanggal')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="finish"
                                class="form-label">Selesai <span class="text-danger">*</span></label>
                            <input type="datetime-local"
                                class="form-control @error('finish') border-danger @enderror"
                                name="finish">
                            @error('finish')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jamkerja"
                                class="form-label">Jam Kerja <span class="text-danger">*</span></label>
                            <select name="jamkerja"
                                id="jamkerja"
                                class="form-control @error('jamkerja') border-danger @enderror">
                                <option value=""
                                    disabled
                                    selected>-- Pilih Jam Kerja --</option>
                                @foreach ($jamkerja as $jk)
                                    <option value="{{ $jk->id }}">{{ $jk->name }}</option>
                                @endforeach
                            </select>
                            @error('jamkerja')
                                <div id="jamkerja"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="action_plan"
                                class="form-label">Action Plan <span class="text-danger">*</span></label>
                            <input type="text"
                                name="action_plan"
                                class="form-control @error('action_plan') border-danger @enderror"
                                id="action_plan"
                                value="{{ old('action_plan') }}">
                            @error('action_plan')
                                <div id="action_plan"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lokasi"
                                class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <select name="lokasi"
                                id="lokasi"
                                class="form-control @error('lokasi') border-danger @enderror">
                                <option value=""
                                    disabled
                                    selected>-- Pilih Lokasi --</option>
                                @foreach ($lokasi as $lk)
                                    <option value="{{ $lk->id }}">{{ $lk->lokasi }}</option>
                                @endforeach
                            </select>
                            @error('downtime')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
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
            <br>
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
                    </div>
                </div>
            </form>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <div style="width: 200px;">
                                    Mesin
                                </div>
                            </th>
                            <th>
                                <div style="width: 50px;">
                                    Line
                                </div>
                            </th>
                            <th>
                                <div style="width: 60px;">
                                    Lokasi
                                </div>
                            </th>
                            <th>
                                <div style="width: 60px;">
                                    Shift
                                </div>
                            </th>
                            <th>
                                <div style="width: 70px;">
                                    Jam Kerja
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px;">
                                    Downtime
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px;">
                                    Mulai
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px">
                                    Finish
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px;">
                                    Action Plan
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px;">
                                    Lama Waktu
                                </div>
                            </th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perawatan as $prw)
                            <tr>
                                <td>{{ $prw->mesin->name }}</td>
                                <td>{{ $prw->lineproduksi->name }}</td>
                                <td>{{ $prw->lokasi->lokasi }}</td>
                                <td>{{ $prw->shift->name }}</td>
                                <td>{{ $prw->jamkerja->name }}</td>
                                <td>{{ $prw->downtime->name }}</td>
                                <td>{{ $prw->tanggal }}</td>
                                <td>{{ $prw->finish }}</td>
                                <td>{{ $prw->action_plan }}</td>
                                <td>{{ $prw->lama_waktu }}</td>
                                <td>
                                    <img src="{{ asset($prw->gambar) }}"
                                        alt=""
                                        width="100">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
