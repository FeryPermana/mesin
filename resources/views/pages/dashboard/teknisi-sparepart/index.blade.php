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
                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Item</th>
                        <th>jumlah</th>
                        <th>Tanggal Update</th>
                        <th>Teknisi Update</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($sparepart as $s)
                            <tr>
                                <td>{{ increment($sparepart, $loop) }}</td>
                                <td>{{ $s->item ?? '-' }}</td>
                                <td>{{ $s->jumlah ?? '-' }}</td>
                                <td>{{ formatTanggalIndo($s->tanggal_update) }}</td>
                                <td>{{ @$s->user->name ?? '-' }}</td>
                                <td>{{ $s->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('teknisi-sparepart.edit', $s->id) }}"
                                        class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>
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
                {{ $sparepart->withQueryString()->links() }}
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>
