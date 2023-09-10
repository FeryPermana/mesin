<x-admin-layout>
    <div class="container">
        <div class="card pt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Perbaikan <strong>{{ $mesin->name }}</strong></h3>
                    </div>
                </div>
                <div class="alert alert-warning text-center">
                    Harus memilih semua indikator terlebih dahulu
                </div>
                <form action="">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="shift"
                                onchange="this.form.submit()"
                                class="form-control custom-select">
                                <option value=""
                                    selected>-- Shift --</option>
                                @foreach ($shift as $sht)
                                    <option value="{{ $sht->id }}"
                                        {{ @$_GET['shift'] == $sht->id ? 'selected' : '' }}>
                                        {{ $sht->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="lineproduksi"
                                class="form-control custom-select"
                                onchange="this.form.submit()">
                                <option value=""
                                    selected>-- Line Produksi --</option>
                                @foreach ($lineproduksi as $lps)
                                    <option value="{{ $lps->id }}"
                                        {{ @$_GET['lineproduksi'] == $lps->id ? 'selected' : '' }}>
                                        {{ $lps->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 pr-md-0 mb-3 mb-md-0">
                            <select name="status"
                                class="form-control custom-select"
                                onchange="this.form.submit()">
                                <option value=""
                                    selected>Status</option>
                                <option value="1"
                                    {{ @$_GET['status'] == 1 ? 'selected' : '' }}>
                                    Open
                                </option>
                                <option value="2"
                                    {{ @$_GET['status'] == 1 ? 'selected' : '' }}>
                                    Closed
                                </option>
                                <option value="3"
                                    {{ @$_GET['status'] == 1 ? 'selected' : '' }}>
                                    Waiting
                                </option>
                            </select>
                        </div>

                        {{-- <div class="col-md-2">
                            <select name="bulan"
                                class="form-control custom-select">
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
                                class="form-control custom-select">
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
                        </div> --}}
                        <div class="col-md-4">
                            <a href="{{ route('request-perbaikan.show', $mesin->id) }}?export-perbaikan=1&shift={{ @$_GET['shift'] }}&lineproduksi={{ @$_GET['lineproduksi'] }}"
                                class="btn btn-success">Excel</a>
                            <button type="submit"
                                name="image"
                                value="1"
                                class="btn btn-danger">Gambar</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <div style="width: 50px;">
                                        Line
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 60px;">
                                        Lokasi
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 60px;">
                                        Shift
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 70px;">
                                        Tanggal Request
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 200px;">
                                        Tanggal Update
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 200px;">
                                        Lama Waktu
                                    </div>
                                </th>
                                <th>
                                    Operator
                                </th>
                                <th>
                                    Teknisi
                                </th>
                                <th>
                                    <div style="width: 200px;">
                                        Action Perbaikan
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 200px">
                                        Pergantian Spare
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 200px">
                                        Kerusakan
                                    </div>
                                </th>
                                <th>
                                    <div style="width: 200px;">
                                        Status
                                    </div>
                                </th>
                                <th>Gambar</th>
                                <th>Print</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perbaikan as $perb)
                                <tr>
                                    <td>{{ @$perb->lineproduksi->name }}</td>
                                    <td>{{ @$perb->mesin->lokasi->lokasi }}</td>
                                    <td>{{ @$perb->shift->name }}</td>
                                    <td>{{ @$perb->tanggal_request }}</td>
                                    <td>{{ @$perb->tanggal_update }}</td>
                                    <td>{{ @$perb->lama_waktu }}</td>
                                    <td>{{ @$perb->operator->name }}</td>
                                    <td>{{ @$perb->teknisi->name }}</td>
                                    <td>{{ @$perb->action }}</td>
                                    <td>{{ @$perb->pergantian_spare }}</td>
                                    <td>{{ @$perb->downtime }}</td>
                                    <td>
                                        <select name="status"
                                            id="status"
                                            class="form-control"
                                            onchange="changestatus(`{{ $perb->id }}`)">
                                            <option value="1"
                                                {{ $perb->status == 1 ? 'selected' : '' }}>Open</option>
                                            <option value="2"
                                                {{ $perb->status == 2 ? 'selected' : '' }}>Closed</option>
                                            <option value="3"
                                                {{ $perb->status == 3 ? 'selected' : '' }}>Waiting</option>
                                        </select>
                                    </td>
                                    <td>
                                        <img src="{{ asset($perb->gambar) }}"
                                            alt=""
                                            width="100">
                                    </td>
                                    <td>
                                        <a href="{{ route('request-perbaikan.print', @$perb->id) }}"
                                            class="btn btn-warning">Print</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function changestatus(perbaikan_id) {
                var dataToSend = {
                    status: $('#status').val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}',
                    }
                })

                $.ajax({
                    type: 'PUT',
                    url: `{{ url('/dashboard/request-perbaikan/${perbaikan_id}') }}`,
                    data: dataToSend,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Berhasil mengubah status !!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
            }
        </script>
    @endpush
</x-admin-layout>
