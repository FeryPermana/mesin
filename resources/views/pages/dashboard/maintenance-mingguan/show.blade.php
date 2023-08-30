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
                        <div class="col-md-2">
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
                        </div>
                        <div class="col-md-4">
                            <button type="submit"
                                class="btn btn-primary">Filter</button>
                            {{-- <a href="{{ route('maintenance-harian.show', $mesin->id) }}?harian=1&shift={{ @$_GET['shift'] }}&lineproduksi={{ @$_GET['lineproduksi'] }}"
                                class="btn btn-success">Excel</a> --}}
                            <a href="{{ route('maintenance-mingguan.show', $mesin->id) }}?print=1&shift={{ @$_GET['shift'] }}&lineproduksi={{ @$_GET['lineproduksi'] }}"
                                class="btn btn-warning">Print</a>
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
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">
                                    <div style="width: 250px;">
                                        Jenis Kegiatan
                                    </div>
                                </th>
                                <th rowspan="2">
                                    <div>
                                        Standart
                                    </div>
                                </th>
                                <th colspan="31"
                                    class="text-center">Pelaksanaan</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i < 5; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($jeniskegiatan as $j)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $j->name }}</td>
                                    <td>{{ $j->standart }}</td>
                                    @foreach ($pengerjaan as $p)
                                        @php
                                            $checklists = $p->checklistmingguan;
                                            
                                            $arraycheck = [];
                                            foreach ($checklists as $checklist) {
                                                $arraycheck[] = $checklist->is_check ? $checklist->jenis_kegiatan_id : 0;
                                            }
                                        @endphp
                                        @if (in_array($j->id, $arraycheck))
                                            <td><i class="ti ti-check"></i></td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @endforeach
                                    @php
                                        $p = 5 - count($pengerjaan);
                                    @endphp
                                    @for ($i = 1; $i < $p; $i++)
                                        <td>-</td>
                                    @endfor
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"><strong>Keterangan</strong></td>
                                <td>Operator</td>
                                @foreach ($pengerjaan as $p)
                                    <td><i class="text-sm">{{ $p->keterangan }}</i></td>
                                    @php
                                        $p = 5 - count($pengerjaan);
                                    @endphp
                                @endforeach
                                @for ($i = 1; $i < $p; $i++)
                                    <td>-</td>
                                @endfor
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Dikerjakan</strong></td>
                                <td>Operator</td>
                                @foreach ($pengerjaan as $p)
                                    <td><i class="text-sm">{{ $p->operator->name }}</i></td>
                                    @php
                                        $p = 5 - count($pengerjaan);
                                    @endphp
                                @endforeach
                                @for ($i = 1; $i < $p; $i++)
                                    <td>-</td>
                                @endfor
                            </tr>
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
