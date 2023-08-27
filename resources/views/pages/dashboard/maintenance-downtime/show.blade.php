<x-admin-layout>
    <div class="container">
        <div class="card pt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Maintenance <strong>{{ $mesin->name }}</strong></h3>
                    </div>
                </div>
                <div class="alert alert-warning text-center">
                    Harus memilih semua indikator terlebih dahulu
                </div>
                <form action="">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="shift"
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
                                class="form-control custom-select">
                                <option value=""
                                    selected>-- Line Produksi --</option>
                                @foreach ($lineproduksi as $lps)
                                    <option value="{{ $lps->id }}"
                                        {{ @$_GET['lineproduksi'] == $lps->id ? 'selected' : '' }}>
                                        {{ $lps->name }}</option>
                                @endforeach
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
                            <button type="submit"
                                class="btn btn-primary">Filter</button>
                            <a href="{{ route('maintenance-downtime.show', $mesin->id) }}?export-downtime=1&shift={{ @$_GET['shift'] }}&lineproduksi={{ @$_GET['lineproduksi'] }}"
                                class="btn btn-success">Excel</a>
                            <button type="submit"
                                name="image"
                                value="1"
                                class="btn btn-danger">Gambar</button>
                        </div>
                    </div>
                </form>
                <br>
                @if (@$_GET['lineproduksi'] && @$_GET['shift'])
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
                                            Jam Kerja
                                        </div>
                                    </th>
                                    <th>
                                        <div style="width: 200px;">
                                            Downtime
                                        </div>
                                    </th>
                                    <th>
                                        <div style="width: 200px;">
                                            Mulai
                                        </div>
                                    </th>
                                    <th>
                                        <div style="width: 200px">
                                            Finish
                                        </div>
                                    </th>
                                    <th>
                                        <div style="width: 200px;">
                                            Action Plan
                                        </div>
                                    </th>
                                    <th>
                                        <div style="width: 200px;">
                                            Lama Waktu
                                        </div>
                                    </th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perawatan as $prw)
                                    <tr>
                                        <td>{{ $prw->lineproduksi->name }}</td>
                                        <td>{{ $prw->lokasi->lokasi }}</td>
                                        <td>{{ $prw->shift->name }}</td>
                                        <td>{{ $prw->jamkerja->name }}</td>
                                        <td>{{ $prw->downtime->name }}</td>
                                        <td>{{ $prw->tanggal }}</td>
                                        <td>{{ $prw->finish }}</td>
                                        <td>{{ $prw->action_plan }}</td>
                                        <td>{{ $prw->lama_waktu }}</td>
                                        <td>
                                            <img src="{{ asset($prw->gambar) }}"
                                                alt=""
                                                width="100">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <div class="text-center">
                            Data belum ada silhakan pilih indikator lain
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-admin-layout>
