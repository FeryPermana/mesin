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
                        <input type="hidden"
                            name="tutorialmesin_id"
                            value="{{ @$tutorialmesin->id }}">
                        <div class="mb-3">
                            <label for="title"
                                class="form-label">Judul Tutorial</label>
                            <input type="text"
                                name="title"
                                class="form-control @error('title') border-danger @enderror"
                                id="title"
                                value="{{ old('title', @$tutorialmesin->title) }}">
                            @error('title')
                                <div id="title"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                    </div>
                    <style>
                        iframe {
                            width: 200px;
                            height: 100px;
                        }
                    </style>
                </div>
                <button type="submit"
                    class="btn btn-primary">Simpan</button>
            </form>
            <br>
            <div class="alert alert-info">
                Lihat disini untuk hasil nya
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 200px;">Judul</th>
                            <th>Line Produksi</th>
                            <th>Deskripsi</th>
                            <th style="width: 150px;">Pdf</th>
                            <th>Video</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tutorialmesins as $tms)
                            <tr>
                                <td>{{ $tms->title }}</td>
                                <td>{{ $tms->lineproduksi->name }}</td>
                                <td>{{ $tms->deskripsi }}</td>
                                <td><a href="{{ asset($tms->file) }}"
                                        class="btn btn-warning"
                                        target="_blank">Lihat File</a></td>
                                <td>{!! $tms->video !!}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class="btn btn-warning"
                                            href="{{ route('mesin.file', $mesin->id) }}?lineproduksi={{ $tms->lineproduksi->id }}&line={{ $tms->lineproduksi->id }}&tutorialmesin={{ $tms->id }}">Edit</a>
                                        <button class="btn btn-danger delete-data"
                                            data-url="{{ route('mesin.lessondelete', $tms->id) }}"
                                            data-id="{{ $tms->id }}">Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.partials.delete')
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
