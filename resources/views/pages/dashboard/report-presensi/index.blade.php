<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-6">
                        <h3>Report Presensi</h3>
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
                    <div class="col-2 pr-md-0 mb-3 mb-md-0">
                        <select name="lineproduksi"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>Line Produksi</option>
                            @foreach ($lineproduksi as $lp)
                                <option value="{{ $lp->id }}"
                                    {{ @$_GET['lineproduksi'] == $lp->id ? 'selected' : '' }}>
                                    {{ $lp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 pr-md-0 mb-3 mb-md-0">
                        <select name="shift"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>Shift</option>
                            @foreach ($shift as $sh)
                                <option value="{{ $sh->id }}"
                                    {{ @$_GET['shift'] == $sh->id ? 'selected' : '' }}>
                                    {{ $sh->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Line Produksi</th>
                        <th>Shift</th>
                        <th>Enumerate</th>
                        <th>Tanggal</th>
                    </thead>
                    <tbody>
                        @forelse ($presensi as $p)
                            <tr>
                                <td>{{ increment($presensi, $loop) }}</td>
                                <td>{{ $p->user->name }}</td>
                                <td>{{ $p->lineproduksi->name }}</td>
                                <td>{{ $p->shift->name }}</td>
                                <td>{{ $p->enumerate == 1 ? 'Shift Panjang' : 'Shift Pendek' }}</td>
                                <td>{{ $p->tanggal }}</td>
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
                {{ $presensi->withQueryString()->links() }}
            </div>

        </div>
    </div>
    @include('pages.partials.delete')
</x-admin-layout>
