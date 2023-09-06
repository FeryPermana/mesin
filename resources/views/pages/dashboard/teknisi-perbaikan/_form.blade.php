<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit Perbaikan</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('teknisi-perbaikan.update', $perbaikan->id) }}"
                method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="shift"
                                class="form-label">Shift <span class="text-danger">*</span></label>
                            <select name="shift"
                                id="shift"
                                class="form-control @error('shift') border-danger @enderror"
                                disabled>
                                <option value=""
                                    disabled
                                    selected>-- Pilih Shift --</option>
                                @foreach ($shift as $s)
                                    <option value="{{ $s->id }}"
                                        {{ $perbaikan->shift_id == $s->id ? 'selected' : '' }}>{{ $s->name }}
                                    </option>
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
                                @if ($perbaikan->lineproduksi_id == $lp->id)
                                    <div class="col-6 mb-2">
                                        <input type="radio"
                                            name="lineproduksi"
                                            disabled
                                            value="{{ $lp->id }}"
                                            {{ $perbaikan->lineproduksi_id == $lp->id ? 'checked' : '' }}>
                                        &nbsp;&nbsp;{{ $lp->name }}
                                    </div>
                                @endif
                            @endforeach
                            @error('lineproduksi')
                                <div id="lineproduksi"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_request"
                                class="form-label">Tanggal Request <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('tanggal_request') border-danger @enderror"
                                name="tanggal_request"
                                disabled
                                value="{{ $perbaikan->tanggal_request }}">
                            @error('tanggal_request')
                                <div id="downtime"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_update"
                                class="form-label">Tanggal Update <span class="text-danger">*</span></label>
                            <input type="text"
                                disabled
                                class="form-control @error('tanggal_update') border-danger @enderror"
                                name="tanggal_update"
                                value="{{ $perbaikan->tanggal_update }}">
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
                                name="action">{{ $perbaikan->action }}</textarea>
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
                                name="pergantian_spare"
                                value="{{ $perbaikan->pergantian_spare }}">
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
                                    data-default-file="{{ asset($perbaikan->gambar) }}">
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
</x-admin-layout>
