<x-admin-layout>
    <h3>Input Downtime</h3>
    <a href="{{ route('downtime.create') }}"
        class="btn btn-primary">Tambah Downtime</a>
    <br>
    <br>
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
                <label for="name"
                    class="form-label">Action Plan <span class="text-danger">*</span></label>
                <input type="text"
                    name="action_plan"
                    class="form-control @error('name') border-danger @enderror"
                    id="name"
                    value="{{ old('name', @$user->name) }}">
                @error('name')
                    <div id="name"
                        class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</x-admin-layout>
