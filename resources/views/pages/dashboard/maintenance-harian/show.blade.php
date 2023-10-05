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
                                    $tahunSekarang = 2025;
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
                            <a href="{{ route('maintenance-harian.show', $mesin->id) }}?print=1&shift={{ @$_GET['shift'] }}&lineproduksi={{ @$_GET['lineproduksi'] }}&bulan={{ @$_GET['bulan'] }}&tahun={{ @$_GET['tahun'] }}"
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
                                @for ($i = 1; $i < 32; $i++)
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
                                            $checklists = $p->checklist;
                                            
                                            $arraycheck = [];
                                            $imgcheck = [];
                                            foreach ($checklists as $checklist) {
                                                $arraycheck[] = $checklist->is_check ? $checklist->jenis_kegiatan_id : 0;
                                                $imgcheck[] = $checklist->is_check ? $checklist->gambar : '';
                                            }
                                        @endphp
                                        @if (in_array($j->id, $arraycheck))
                                            @php
                                                $cari = array_search($j->id, $arraycheck);
                                            @endphp
                                            <td>
                                                @if ($checklists[$cari]->gambar != '')
                                                    <a href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#checkModal{{ $cari }}"><i
                                                            class="ti ti-check"></i></a>
                                                @else
                                                    <i class="ti ti-check"></i>
                                                @endif
                                            </td>
                                            <div class="modal fade"
                                                id="checkModal{{ $cari }}"
                                                tabindex="-1"
                                                aria-labelledby="checkModal{{ $cari }}Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="checkModal{{ $cari }}Label">Preview
                                                                Gambar
                                                            </h1>
                                                            <button type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset($checklists[$cari]->gambar) }}"
                                                                alt=""
                                                                width="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @endforeach
                                    @php
                                        $p = 32 - count($pengerjaan);
                                    @endphp
                                    @for ($i = 1; $i < $p; $i++)
                                        <td>-</td>
                                    @endfor
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Gambar</td>
                                @foreach ($pengerjaan as $p)
                                    @if ($p->gambar)
                                        <td><img src="{{ asset($p->gambar) }}"
                                                alt=""
                                                width="50"
                                                style="cursor: pointer;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#pengerjaanModal{{ $p->id }}"></td>
                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="pengerjaanModal{{ $p->id }}"
                                            tabindex="-1"
                                            aria-labelledby="pengerjaanModal{{ $p->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="pengerjaanModal{{ $p->id }}Label">Preview Gambar
                                                        </h1>
                                                        <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset($p->gambar) }}"
                                                            alt=""
                                                            width="100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <td>-</td>
                                    @endif
                                @endforeach
                                @php
                                    $p = 32 - count($pengerjaan);
                                @endphp
                                @for ($i = 1; $i < $p; $i++)
                                    <td>-</td>
                                @endfor
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Dikerjakan</strong></td>
                                <td>Operator</td>
                                @foreach ($pengerjaan as $p)
                                    <td><i style="font-size: 8px;">{{ $p->operator->name }}</i></td>
                                @endforeach
                                @php
                                    $p = 32 - count($pengerjaan);
                                @endphp
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
