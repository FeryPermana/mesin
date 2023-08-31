<x-admin-layout>
    <div class="container">
        <div class="card pt-5">
            <div class="card-body">
                <div class="row">
                    @php
                        $date = new DateTime($pengerjaan[0]->tanggal ?? '');
                        $monthYearString = generateMonthYearStringFromDate($date);
                    @endphp
                    <div class="col-md-12">
                        <h3>Maintenance mesin <strong>{{ $mesin->name }}</strong></h3>
                        <p>Bulan / Tahun : {{ @$_GET['bulan'] }} {{ @$_GET['tahun'] }} </p>
                    </div>
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
                            {{-- <a href="{{ route('maintenance-bulanan.show', $mesin->id) }}?harian=1&shift={{ @$_GET['shift'] }}&lineproduksi={{ @$_GET['lineproduksi'] }}"
                                class="btn btn-success">Excel</a> --}}
                            <button type="submit"
                                name="image"
                                value="1"
                                class="btn btn-danger">Gambar</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row">
                    @foreach ($pengerjaan as $p)
                        <div class="col-md-4 mt-3">
                            <img src="{{ asset($p->gambar) }}"
                                alt=""
                                width="100%"
                                class="img-thumbnail">
                            <p class="text-center">{{ $p->tanggal }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
