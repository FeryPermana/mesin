<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Tutorial Mesin</h3>
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
                <div class="mb-3">
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
                <div class="mb-3">
                    <label for="title"
                        class="form-label">Judul</label>
                    <select name="title"
                        required
                        id="tutorialmesin"
                        class="form-control @error('tutorialmesin') border-danger @enderror"
                        onchange="this.form.submit()">
                        <option value=""
                            selected
                            disabled>-- Pilih Judul --</option>
                        @foreach ($tutorialmesin as $tm)
                            <option value="{{ $tm->title }}"
                                {{ @$_GET['title'] == $tm->title ? 'selected' : '' }}>{{ $tm->title }}</option>
                        @endforeach
                    </select>
                    @error('tutorialmesin')
                        <div id="tutorialmesin"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>

            @if (@$_GET['mesinkey'] && @$_GET['lineproduksi'] && @$_GET['title'])
                <div class="mb-3">
                    <a href="{{ asset(@$tutorial->file) }}"
                        class="btn btn-success"
                        target="_blank">Tutorial PDF</a>
                </div>
                <div class="mb-3">
                    <style>
                        iframe {
                            width: 100%;
                            height: 400px;
                        }
                    </style>
                    {!! @$tutorial->video !!}
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <p>{{ @$tutorial->deskripsi }}</p>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
