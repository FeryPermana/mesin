<x-admin-layout>
    <h2>Input Produksi</h2>
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
                <label for="tanggal"
                    class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="date"
                    name="tanggal"
                    id="tanggal"
                    class="form-control">
            </div>

        </div>
    </div>
</x-admin-layout>
