<x-admin-layout>
    @push('styles')
        <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Perawatan Harian</h3>
                    </div>
                </div>
            </div>
            @if ($method == 'store')
                <div class="alert alert-warning">
                    Pilih Mesin terlebih dahulu !!
                </div>
            @else
                <a href="{{ route('perawatan.index') }}"
                    class="btn btn-primary">Tambah Baru</a>
                <br>
                <br>
            @endif
            <form action=""
                method="GET">
                <div class="mb-3">
                    <label for="mesinkey"
                        class="form-label">Mesin</label>
                    <select name="mesinkey"
                        required
                        {{ @$pengerjaanedit->mesin_id ? 'disabled' : '' }}
                        id="mesin"
                        class="form-control @error('mesin') border-danger @enderror"
                        onchange="this.form.submit()">
                        <option value=""
                            selected
                            disabled>-- Pilih Mesin --</option>
                        @foreach ($mesin as $m)
                            @if (auth()->user()->lokasi_id == $m->lokasi_id)
                                <option value="{{ $m->id }}"
                                    {{ @$_GET['mesinkey'] == $m->id || @$pengerjaanedit->mesin_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('mesin')
                        <div id="mesin"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
            <form action="{{ $url }}"
                method="POST"
                enctype="multipart/form-data"
                id="perawatan-form">
                @csrf
                <div class="mb-3">
                    <input type="hidden"
                        name="mesin"
                        value="{{ @$_GET['mesinkey'] }}">
                    <label for="tanggal"
                        class="form-label">Tanggal Now</label>
                    <input type="date"
                        name="tanggal"
                        class="form-control @error('tanggal') border-danger @enderror"
                        id="tanggal"
                        {{ @$pengerjaanedit->tanggal ? 'disabled' : '' }}
                        value="{{ old('tanggal', @$pengerjaanedit->tanggal) }}">
                    @error('tanggal')
                        <div id="tanggal"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="shift"
                        class="form-label">Shift</label>
                    <select name="shift"
                        id="shift"
                        {{ @$pengerjaanedit->shift_id ? 'disabled' : '' }}
                        class="form-control @error('shift') border-danger @enderror">
                        <option value=""
                            selected
                            disabled>-- Pilih Shift --</option>
                        @foreach ($shift as $s)
                            <option value="{{ $s->id }}"
                                {{ old('shift', @$pengerjaanedit->shift_id) == $s->id ? 'selected' : '' }}>
                                {{ $s->name }}</option>
                        @endforeach
                    </select>
                    @error('shift')
                        <div id="shift"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="lineproduksi"
                        class="form-label">Line Produksi</label>
                    <select name="lineproduksi"
                        id="lineproduksi"
                        {{ @$pengerjaanedit->lineproduksi_id ? 'disabled' : '' }}
                        class="form-control @error('lineproduksi') border-danger @enderror">
                        <option value=""
                            selected
                            disabled>-- Pilih Line Produksi --</option>
                        @foreach ($lineproduksi as $l)
                            <option value="{{ $l->id }}"
                                {{ old('lineproduksi', @$pengerjaanedit->lineproduksi_id) == $l->id ? 'selected' : '' }}>
                                {{ $l->name }}</option>
                        @endforeach
                    </select>
                    @error('lineproduksi')
                        <div id="lineproduksi"
                            class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-8">
                            <label class="form-label">Jenis Kegiatan</label>
                            <table class="table table-bordered">
                                @foreach ($jeniskegiatan as $key => $jk)
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                                name="jenis_kegiatan[]"
                                                value="{{ $jk->id }}"
                                                id="jenis{{ $jk->id }}"
                                                {{ $jk->id == @$pengerjaanedit->checklist[$key]->jenis_kegiatan_id && $pengerjaanedit->checklist[$key]->is_check == 1 ? 'checked' : '' }}
                                                onchange="gambarJenisKegiatan({{ $jk->id }})">
                                        </td>
                                        <td>{{ $jk->name }}</td>
                                        <td>{{ $jk->standart }}</td>
                                        <td>
                                            <div id="img{{ $jk->id }}">
                                                @if ($jk->id == @$pengerjaanedit->checklist[$key]->jenis_kegiatan_id && $pengerjaanedit->checklist[$key]->is_check)
                                                    <input type="file"
                                                        name="img[]"
                                                        class="form-control">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Gambar Mesin
                                    <br>
                                    <small class="text-muted fw-normal">Valid File: jpg, jpeg, png | Max Size:
                                        5MB</small>
                                </label>
                                @if (@$pengerjaanedit->gambar)
                                    <input type="file"
                                        name="gambar"
                                        class="dropify"
                                        data-default-file="{{ asset(@$pengerjaanedit->gambar) }}">
                                @else
                                    <input type="file"
                                        name="gambar"
                                        class="dropify"
                                        data-default-file="file">
                                    @error('gambar')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#"
                    class="btn btn-primary"
                    onclick="submit()">Simpan</a>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning text-center">
                Harus memilih semua indikator terlebih dahulu
            </div>
            <form action="">
                <input type="hidden"
                    name="mesinkey"
                    value="{{ @$_GET['mesinkey'] }}">
                <div class="row">
                    <div class="col-md-3 mt-2">
                        <select name="mesin"
                            class="form-control custom-select">
                            <option value=""
                                selected>-- Mesin --</option>
                            @foreach ($mesin as $mes)
                                @if (auth()->user()->lokasi_id == $mes->lokasi_id)
                                    <option value="{{ $mes->id }}"
                                        {{ @$_GET['mesin'] == $mes->id ? 'selected' : '' }}>
                                        {{ $mes->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2">
                        <select name="shift"
                            class="form-control custom-select">
                            <option value=""
                                selected>-- Shift --</option>
                            @foreach ($shift as $sht)
                                <option value="{{ $sht->id }}"
                                    {{ @$_GET['shift'] == $sht->id ? 'selected' : '' }}>
                                    {{ $sht->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2">
                        <select name="lineproduksi"
                            class="form-control custom-select">
                            <option value=""
                                selected>-- Line Produksi --</option>
                            @foreach ($lineproduksi as $lps)
                                <option value="{{ $lps->id }}"
                                    {{ @$_GET['lineproduksi'] == $lps->id ? 'selected' : '' }}>
                                    {{ $lps->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2">
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
                    <div class="col-md-3 mt-2">
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
                    <div class="col-md-3 mt-2">
                        <button type="submit"
                            class="btn btn-primary">Filter</button>
                        <a href="{{ route('perawatan.index') }}"
                            class="btn btn-warning">Reset</a>
                    </div>
                </div>
            </form>
            <br>
            @if (@$_GET['mesin'] && @$_GET['lineproduksi'] && @$_GET['shift'])
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
                                                <i class="ti ti-check"></i>
                                            @endif
                                        </td>
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
                                @else
                                    <td><a href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#pengerjaanModal{{ $p->id }}">-</a></td>
                                @endif
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
                                                @if ($p->gambar)
                                                    <img src="{{ asset($p->gambar) }}"
                                                        alt=""
                                                        width="100%">
                                                @else
                                                    <h3>Tidak ada Gambar</h3>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('perawatan.edit', $p->id) }}?mesinkey={{ $p->mesin_id }}&mesin={{ $p->mesin_id }}&shift={{ $p->shift_id }}&lineproduksi={{ $p->lineproduksi_id }}"
                                                    class="btn btn-warning">Edit Atau Lengkapi Checklist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    @push('scripts')
        <script>
            function submit() {
                Swal.fire({
                    title: 'Checklist anda belum lengkap apakah ingin submit ?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#perawatan-form').submit();
                    }
                })
            }
        </script>
        <script>
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });

            function gambarJenisKegiatan(id) {
                if ($('#jenis' + id).is(':checked')) {
                    $('#img' + id).append(`
                    <input type="file" name="img[]" class="form-control">
                `);
                } else {
                    $('#img' + id).html('');
                }
            }
        </script>
    @endpush
</x-admin-layout>
