<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Request Perbaikan</h3>
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
            <form action="{{ route('operator-perbaikan.store') }}"
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
                            <label for="tanggal_request"
                                class="form-label">Tanggal Request <span class="text-danger">*</span></label>
                            <input type="datetime-local"
                                class="form-control @error('tanggal_request') border-danger @enderror"
                                name="tanggal_request">
                            @error('tanggal_request')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_update"
                                class="form-label">Tanggal Update <span class="text-danger">*</span></label>
                            <input type="datetime-local"
                                class="form-control @error('tanggal_update') border-danger @enderror"
                                name="tanggal_update">
                            @error('tanggal_update')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="action"
                                class="form-label">Action Perbaikan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('action') border-danger @enderror"
                                name="action"> </textarea>
                            @error('action')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pergantian_spare"
                                class="form-label">Pergantian Spare <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('pergantian_spare') border-danger @enderror"
                                name="pergantian_spare">
                            @error('pergantian_spare')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Gambar
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
                            @foreach ($lineproduksis as $linpr)
                                <option value="{{ $linpr->id }}"
                                    {{ @$_GET['lineproduksi'] == $linpr->id ? 'selected' : '' }}>
                                    {{ $linpr->name }}
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
                                    Tanggal Request
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px;">
                                    Tanggal Update
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px;">
                                    Action Perbaikan
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px">
                                    Pergantian Spare
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px">
                                    Lama Waktu
                                </div>
                            </th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perbaikan as $perb)
                            <tr>
                                <td>{{ $perb->mesin->name }}</td>
                                <td>{{ $perb->lineproduksi->name }}</td>
                                <td>{{ $perb->mesin->lokasi->lokasi }}</td>
                                <td>{{ $perb->shift->name }}</td>
                                <td>{{ $perb->tanggal_request }}</td>
                                <td>{{ $perb->tanggal_update }}</td>
                                <td>{{ $perb->action }}</td>
                                <td>{{ $perb->pergantian_spare }}</td>
                                <td>{{ $perb->lama_waktu }}</td>
                                <td>
                                    <img src="{{ asset($perb->gambar) }}"
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
