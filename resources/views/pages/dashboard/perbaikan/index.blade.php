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
            <form>
                <div class="row my-5">
                    <div class="col-2 pr-md-0 mb-3 mb-md-0">
                        @php
                            $rows = [10, 50, 100, 500];
                        @endphp
                        <select name="row"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            @foreach ($rows as $row)
                                <option value="{{ $row }}"
                                    {{ @$_GET['row'] == $row ? 'selected' : '' }}>
                                    {{ $row }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 pr-md-0 mb-3 mb-md-0">
                        <select name="mesin"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>Mesin</option>
                            @foreach ($mesin as $mes)
                                <option value="{{ $mes->id }}"
                                    {{ @$_GET['mesin'] == $mes->id ? 'selected' : '' }}>
                                    {{ $mes->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5 ml-auto">
                        <div class="custom-search">
                            <input type="text"
                                class="form-control"
                                name="search"
                                placeholder="Cari nama..."
                                value="{{ @$_GET['search'] }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Mesin</th>
                        <th>Merk</th>
                        <th>Lokasi</th>
                        <th>Tahun Pembuatan</th>
                        <th>Periode Pakai</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($perbaikan as $per)
                            @if (auth()->user()->role != 1)
                                @if (auth()->user()->lokasi_id == $per[0]->mesin->lokasi_id)
                                    <tr>
                                        <td>{{ $per[0]->mesin->name }}</td>
                                        <td>{{ $per[0]->mesin->merk }}</td>
                                        <td>{{ $per[0]->mesin->lokasi->lokasi }}</td>
                                        <td>{{ $per[0]->mesin->tahun_pembuatan }}</td>
                                        <td>{{ $per[0]->mesin->periode_pakai }}</td>
                                        <td>
                                            <a href="{{ route('request-perbaikan.show', $per[0]->mesin->id) }}"
                                                class="btn btn-warning">Detail</a>
                                        </td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td>{{ $per[0]->mesin->name }}</td>
                                    <td>{{ $per[0]->mesin->merk }}</td>
                                    <td>{{ $per[0]->mesin->lokasi->lokasi }}</td>
                                    <td>{{ $per[0]->mesin->tahun_pembuatan }}</td>
                                    <td>{{ $per[0]->mesin->periode_pakai }}</td>
                                    <td>
                                        <a href="{{ route('request-perbaikan.show', $per[0]->mesin->id) }}"
                                            class="btn btn-warning">Detail</a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">
                                        <div class="alert alert-warning"
                                            role="alert">
                                            Data tidak ada
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>
