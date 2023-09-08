<x-admin-layout>
    <div class="container">
        <div class="card pt-5">
            <div class="card-body">
                <div class="row">
                    @php
                        $date = new DateTime($pengerjaan[0]->tanggal_request ?? '');
                        $monthYearString = generateMonthYearStringFromDate($date);
                    @endphp
                    <div class="col-md-12">
                        <h3>Perbaikan <strong>{{ $mesin->name }}</strong></h3>
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
                            <select name="tingkat"
                                class="form-control custom-select">
                                <option value=""
                                    selected>-- Tingkat --</option>
                                <option value="teknisi"
                                    {{ @$_GET['tingkat'] == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                                <option value="operator"
                                    {{ @$_GET['tingkat'] != 'teknisi' ? 'selected' : '' }}>Operator</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <a href="{{ route('maintenance-harian.show', $mesin->id) }}?harian=1&shift={{ @$_GET['shift'] }}&lineproduksi={{ @$_GET['lineproduksi'] }}"
                                class="btn btn-success">Excel</a> --}}
                            <button type="submit"
                                name="image"
                                value="1"
                                class="btn btn-danger">Gambar</button>
                            <a href="{{ route('request-perbaikan.show', $mesin->id) }}"
                                class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row">
                    @foreach ($perbaikan as $p)
                        <div class="col-md-4 mt-3">
                            @if (@$_GET['teknisi'])
                                <img src="{{ asset($p->gambar) }}"
                                    alt=""
                                    width="100%"
                                    class="img-thumbnail">
                                <p class="text-center">{{ $p->tanggal_request }} - {{ $p->tanggal_update }}</p>
                            @else
                                <img src="{{ asset($p->operator_gambar) }}"
                                    alt=""
                                    width="100%"
                                    class="img-thumbnail">
                                <p class="text-center">{{ $p->tanggal_request }} - {{ $p->tanggal_update }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
