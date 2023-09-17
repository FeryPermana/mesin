<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-6">
                        <h3>List Spare Part</h3>
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
                    <div class="col-md-4 mb-3 ml-auto">
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
                <table class="table table-bordered"
                    style="width: max-content;">
                    <thead>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stock Update</th>
                        <th>Shift</th>
                        <th>Alokasi Line</th>
                        <th>Tanggal Update Keluar</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($sparepart as $s)
                            <tr>
                                <td>{{ increment($sparepart, $loop) }}</td>
                                <td>{{ $s->kode_barang ?? '-' }}</td>
                                <td>{{ $s->item ?? '-' }}</td>
                                <td>{{ $s->stock ?? '-' }}</td>
                                <td>{{ @$s->shift->name ?? '-' }}</td>
                                <td>{{ @$s->lineproduksi->name ?? '-' }}</td>
                                <td>{{ formatTanggalIndo($s->tanggal_keluar) }}</td>
                                <td>{{ $s->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('teknisi-sparepart.edit', $s->id) }}"
                                        class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
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
                {{ $sparepart->withQueryString()->links() }}
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>
