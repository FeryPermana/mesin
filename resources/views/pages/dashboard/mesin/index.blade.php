<x-admin-layout>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>List Mesin</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('mesin.create') }}"
                        class="btn btn-primary">Tambah</a>
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
                <table class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($mesin as $m)
                            <tr>
                                <td>{{ increment($mesin, $loop) }}</td>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->merk }}</td>
                                <td>{{ $m->kapasitas }}</td>
                                <td>
                                    <a href="{{ route('mesin.edit', $m->id) }}"
                                        class="btn btn-warning"><i class="ti ti-pencil"></i> Edit</a>

                                    <button class="btn btn-danger delete-data"
                                        data-url="{{ route('mesin.destroy', $m->id) }}"
                                        data-id="{{ $m->id }}">
                                        <i class="ti ti-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
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
