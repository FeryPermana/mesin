<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Report Monitoring Suhu</h3>
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
                        <select name="operator"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>Operator</option>
                            @foreach ($operators as $operator)
                                <option value="{{ $operator->id }}"
                                    {{ @$_GET['operator'] == $operator->id ? 'selected' : '' }}>
                                    {{ $operator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="bulan"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>-- Bulan --</option>
                            @foreach (bulan_list() as $bulan)
                                <option value="{{ $bulan }}"
                                    {{ @$_GET['bulan'] == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="tahun"
                            class="form-control custom-select"
                            onchange="this.form.submit()">
                            <option value=""
                                selected>-- Tahun --</option>
                            @php
                                $tahunSekarang = date('Y');
                            @endphp
                            @for ($tahun = $tahunSekarang; $tahun >= 2022; $tahun--)
                                <option value="{{ $tahun }}"
                                    {{ @$_GET['tahun'] == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-warning"
                            onclick="this.form.submit()"
                            name="print"
                            value="1">Print</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Tanggal</th>
                        <th>Suhu</th>
                        <th>Rh</th>
                        <th>Operator</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        @forelse ($monitoringsuhu as $ms)
                            <tr>
                                <td>{{ $ms->tanggal }}</td>
                                <td>{{ $ms->suhu }}</td>
                                <td>{{ $ms->rh }}</td>
                                <td>{{ $ms->operator->name }}</td>
                                <td>{{ $ms->keterangan }}</td>
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
                {{ $monitoringsuhu->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
