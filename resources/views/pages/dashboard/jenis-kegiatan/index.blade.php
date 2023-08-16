<x-admin-layout>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Jenis Kegiatan</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('jenis-kegiatan.create') }}"
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
                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Standart</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($jeniskegiatan as $j)
                            <tr>
                                <td>{{ increment($jeniskegiatan, $loop) }}</td>
                                <td>{{ $j->name }}</td>
                                <td>{{ $j->standart }}</td>
                                <td>
                                    <a href="{{ route('jenis-kegiatan.edit', $j->id) }}"
                                        class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i> Edit</a>

                                    <button class="btn btn-danger btn-sm delete-data"
                                        data-url="{{ route('jenis-kegiatan.destroy', $j->id) }}"
                                        data-id="{{ $j->id }}">
                                        <i class="ti ti-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
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
                {{ $jeniskegiatan->withQueryString()->links() }}
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>
