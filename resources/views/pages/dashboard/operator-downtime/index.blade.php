<x-admin-layout>
    <h3>Input Downtime</h3>
    <br>
    <br>
    <form action="{{ route('operator-downtime.store') }}"
        method="POST">
        @csrf
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
                    <label for="action_plan"
                        class="form-label">Action Plan <span class="text-danger">*</span></label>
                    <input type="text"
                        name="action_plan"
                        class="form-control @error('action_plan') border-danger @enderror"
                        id="action_plan"
                        value="{{ old('action_plan', @$user->action_plan) }}">
                    @error('action_plan')
                        <div id="action_plan"
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
                    @error('downtime')
                        <div id="downtime"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal"
                        class="form-label">Mulai <span class="text-danger">*</span></label>
                    <input type="date"
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
                    <input type="date"
                        class="form-control @error('finish') border-danger @enderror"
                        name="finish">
                    @error('finish')
                        <div id="downtime"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="lama_waktu"
                        class="form-label">Lama Waktu <span class="text-danger">*</span></label>
                    <input type="number"
                        name="lama_waktu"
                        class="form-control @error('lama_waktu') border-danger @enderror"
                        id="lama_waktu"
                        value="{{ old('lama_waktu', @$user->lama_waktu) }}">
                    @error('lama_waktu')
                        <div id="lama_waktu"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit"
                class="btn btn-primary">Simpan</button>
        </div>
    </form>
</x-admin-layout>
