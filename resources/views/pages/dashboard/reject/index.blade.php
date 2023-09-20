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
                        <h3>Reject</h3>
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
                            <th>Reject Botol</th>
                            <th>Reject Tutup</th>
                            <th>Reject Produksi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $rejectbotol = [];
                            $rejecttutup = [];
                            $rejectproduksi = [];
                        @endphp
                        @foreach ($rejects as $reject)
                            @php
                                $rejectbotol[] = $reject->reject_botol;
                                $rejecttutup[] = $reject->reject_tutup;
                                $rejectproduksi[] = $reject->reject_produksi;
                            @endphp
                            <tr>
                                <td>{{ formatTanggalIndo($reject->tanggal) }}</td>
                                <td>{{ $reject->shift->name }}</td>
                                <td>{{ $reject->jamkerja->name }}</td>
                                <td>{{ number_format($reject->reject_botol) }} pcs</td>
                                <td>{{ number_format($reject->reject_tutup) }} pcs</td>
                                <td>{{ number_format($reject->reject_produksi) }} pcs</td>
                                <td>{{ $reject->keterangan }} pcs</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Jumlah</td>
                            <td>{{ number_format(array_sum($rejectbotol)) }} pcs</td>
                            <td>{{ number_format(array_sum($rejecttutup)) }} pcs</td>
                            <td>{{ number_format(array_sum($rejectproduksi)) }} pcs</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
