<x-admin-layout>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Produksi</h3>
                    </div>
                </div>
            </div>
            <form action="">
                <div class="row">
                    <div class="col-md-3">
                        <select name="tanggal"
                            id="tanggal"
                            class="form-control">
                            <option value="">select tanggal</option>
                            @foreach ($tanggal as $tgl)
                                <option value="{{ $tgl->tanggal }}"
                                    {{ @$_GET['tanggal'] == $tgl->tanggal ? 'selected' : '' }}>
                                    {{ formatTanggalIndo($tgl->tanggal) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="shift"
                            id="shift"
                            class="form-control">
                            <option value="">select shift</option>
                            @foreach ($shifts as $shift)
                                <option value="{{ $shift->id }}"
                                    {{ @$_GET['shift'] == $shift->id ? 'selected' : '' }}>{{ $shift->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="lineproduksi"
                            id="lineproduksi"
                            class="form-control">
                            <option value="">select line produksi</option>
                            @foreach ($lineproduksis as $lineproduksi)
                                <option value="{{ $lineproduksi->id }}"
                                    {{ @$_GET['lineproduksi'] == $lineproduksi->id ? 'selected' : '' }}>
                                    {{ $lineproduksi->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit"
                            class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-3">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Jam Kerja</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = [];
                        @endphp
                        @foreach ($produksis as $produksi)
                            @php
                                $total[] = $produksi->pallet;
                            @endphp
                            <tr>
                                <td>{{ formatTanggalIndo($produksi->tanggal) }}</td>
                                <td>{{ $produksi->shift->name }}</td>
                                <td>{{ $produksi->jamkerja->name }}</td>
                                <td>{{ number_format($produksi->pallet) }}</td>
                                <td>{{ $produksi->keterangan }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Jumlah Pallet</td>
                            <td>{{ number_format(array_sum($total)) }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
