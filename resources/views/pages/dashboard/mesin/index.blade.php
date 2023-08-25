<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-6">
                        <h3>List Mesin</h3>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('mesin.create') }}"
                            class="btn btn-primary">Tambah</a>
                    </div>
                </div>
            </div>
            <form>
                <div class="row">
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

                    <div class="col-md-5 mb-3 ml-auto">
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
                        <th>No</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Kapasitas</th>
                        <th>Lokasi</th>
                        <th>Tahun Pembuatan</th>
                        <th>Periode Pakai</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($mesin as $m)
                            <tr>
                                <td>{{ increment($mesin, $loop) }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->merk }}</td>
                                <td>{{ $m->kapasitas }}</td>
                                <td>{{ $m->lokasi->lokasi }}</td>
                                <td>{{ $m->tahun_pembuatan }}</td>
                                <td>{{ $m->periode_pakai }}</td>
                                <td>
                                    <a href="{{ route('mesin.edit', $m->id) }}?type=harian"
                                        class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>

                                    <button class="btn btn-danger btn-sm delete-data"
                                        data-url="{{ route('mesin.destroy', $m->id) }}"
                                        data-id="{{ $m->id }}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
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
            <div class="d-flex justify-content-end">
                {{ $mesin->withQueryString()->links() }}
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>
