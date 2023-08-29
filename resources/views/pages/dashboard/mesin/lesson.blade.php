<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ $mesin->name }}</h2>
                    </div>
                </div>
            </div>
            {{-- @foreach ($lineproduksi as $lpr)
                @php
                    $hasline = App\Models\HasLine::where('mesin_id', @$mesin->id)
                        ->where('lineproduksi_id', $lpr->id)
                        ->first();
                @endphp
                <a href="{{ route('mesin.file', $mesin->id) }}?line={{ $lpr->id }}"
                    class="btn {{ @$_GET['line'] == $lpr->id ? 'btn-primary' : 'btn-outline-primary' }}">{{ $lpr->name }}</a>
            @endforeach
            <br>
            <br> --}}
            <form action=""
                method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Line Produksi</label>
                        <div class="row"
                            id="checkline">
                            @foreach ($lineproduksi as $lp)
                                <div class="col-6 mb-2">
                                    <input type="radio"
                                        name="lineproduksi"
                                        onchange="this.form.submit()"
                                        value="{{ $lp->id }}"
                                        {{ $lp->id == @$_GET['lineproduksi'] ? 'checked' : '' }}>
                                    &nbsp;&nbsp;{{ $lp->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ $url }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($method == 'update')
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden"
                            name="lineproduksi_id"
                            value="{{ @$_GET['lineproduksi'] }}">
                        <div class="mb-3">
                            <label for="deskripsi"
                                class="form-label">Deskripsi</label>
                            <textarea name="deskripsi"
                                class="form-control @error('deskripsi') border-danger @enderror"
                                id="deskripsi">{{ old('deskripsi', @$tutorialmesin->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div id="deskripsi"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="video"
                                class="form-label">Embed Video Youtube</label>
                            <textarea name="video"
                                class="form-control @error('video') border-danger @enderror"
                                rows="6"
                                id="video">{{ old('video', @$tutorialmesin->video) }}</textarea>
                            @error('video')
                                <div id="video"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file"
                                class="form-label">File</label>
                            <input type="file"
                                name="file"
                                class="form-control @error('file') border-danger @enderror"
                                id="file"
                                value="{{ old('file', @$tutorialmesin->file) }}">
                            @error('file')
                                <div id="file"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (@$_GET['lineproduksi'])
                            <div class="mb-3">
                                <a href="{{ asset(@$tutorialmesin->file) }}"
                                    class="btn btn-success btn-sm"
                                    target="_blank">Lihat File</a>
                            </div>
                            <div class="mb-3">
                                <style>
                                    iframe {
                                        width: 100%;
                                    }
                                </style>
                                {!! @$tutorialmesin->video !!}
                            </div>
                        @endif
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
