<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Shift</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('shift.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
            </div>
            <form>
                <div class="row">
                    <div class="col-2 pr-md-0 mb-3 mb-md-0">
                        @php
                        $rows = [10, 50, 100, 500];
                        @endphp
                        <select name="row" class="form-control custom-select" onchange="this.form.submit()">
                            @foreach ($rows as $row)
                            <option value="{{ $row }}" {{ @$_GET['row'] == $row ? 'selected' : '' }}>
                                {{ $row }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5 mb-3 ml-auto">
                        <div class="custom-search">
                            <input type="text" class="form-control" name="search" placeholder="Cari nama..." value="{{ @$_GET['search'] }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($shift as $m)
                        <tr>
                            <td>{{ increment($shift, $loop) }}</td>
                            <td>{{ $m->name }}</td>
                            <td>
                                <a href="{{ route('shift.edit', $m->id) }}" class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i> Edit</a>

                                <button class="btn btn-danger btn-sm delete-data" data-url="{{ route('shift.destroy', $m->id) }}" data-id="{{ $m->id }}">
                                    <i class="ti ti-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center">
                                    <div class="alert alert-warning" role="alert">
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
                {{ $shift->withQueryString()->links() }}
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>