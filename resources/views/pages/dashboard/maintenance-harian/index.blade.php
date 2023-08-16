<x-admin-layout>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Maintenance Harian</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                                    {{ $row }}</option>
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
                                    {{ $mes->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 pr-md-0 mb-3 mb-md-0">
                        <select name="shift"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>Shift</option>
                            @foreach ($shift as $sh)
                                <option value="{{ $sh->id }}"
                                    {{ @$_GET['shift'] == $sh->id ? 'selected' : '' }}>
                                    {{ $sh->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 pr-md-0 mb-3 mb-md-0">
                        <select name="lineproduksi"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>Line Produksi</option>
                            @foreach ($lineproduksi as $lp)
                                <option value="{{ $lp->id }}"
                                    {{ @$_GET['lineproduksi'] == $lp->id ? 'selected' : '' }}>
                                    {{ $lp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5 my-3 ml-auto">
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
                        <th>Lokasi</th>
                        <th>Line Produksi</th>
                        <th>Shift</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($maintenance as $m)
                            <tr>
                                <td>{{ increment($maintenance, $loop) }}</td>
                                <td>{{ $m->mesin->name }}</td>
                                <td>{{ $m->mesin->lokasi->lokasi }}</td>
                                <td>{{ $m->lineproduksi->name }}</td>
                                <td>{{ $m->shift->name }}</td>
                                <td>
                                    <a href=""
                                        class="btn btn-warning">Detail</a>
                                </td>
                            </tr>
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
            <div class="d-flex justify-content-end">
                {{ $maintenance->withQueryString()->links() }}
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>
