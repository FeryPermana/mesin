<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $method == 'update' ? 'Ubah Mesin' : 'Tambah Mesin' }}</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('mesin.index') }}"
                            class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ $url }}"
                method="POST">
                @csrf
                @if ($method == 'update')
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="item"
                                class="form-label">Item Spare Part</label>
                            <input type="text"
                                name="item"
                                class="form-control @error('item') border-danger @enderror"
                                id="item"
                                value="{{ old('item', @$sparepart->item) }}">
                            @error('item')
                                <div id="item"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
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
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });
            $("#selectLine").click(function() {
                $("#checkline input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });
        </script>
    @endpush
</x-admin-layout>
