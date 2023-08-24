<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $method == 'update' ? 'Ubah Mesin' : 'Tambah Mesin' }}</h3>
                        <a href="{{ route('jenis-kegiatan.index') }}"
                            class="btn btn-success">Atur disini untuk jenis kegiatan</a>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('mesin.index') }}"
                            class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ $url }}"
                method="POST">
                @csrf
                @if ($method == 'update')
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name"
                                class="form-label">Nama</label>
                            <input type="text"
                                name="name"
                                class="form-control @error('name') border-danger @enderror"
                                id="name"
                                value="{{ old('name', @$mesin->name) }}">
                            @error('name')
                                <div id="name"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="merk"
                                class="form-label">Merk</label>
                            <input type="text"
                                name="merk"
                                class="form-control @error('merk') border-danger @enderror"
                                id="merk"
                                value="{{ old('merk', @$mesin->merk) }}">
                            @error('merk')
                                <div id="merk"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas"
                                class="form-label">Kapasitas</label>
                            <input type="text"
                                name="kapasitas"
                                class="form-control @error('kapasitas') border-danger @enderror"
                                id="kapasitas"
                                value="{{ old('kapasitas', @$mesin->kapasitas) }}">
                            @error('kapasitas')
                                <div id="kapasitas"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (@$user->role == 2 || @$user->role == '')
                            <div class="mb-3">
                                <label for="lokasi"
                                    class="form-label">Lokasi</label>
                                <select name="lokasi"
                                    id="lokasi"
                                    class="form-control @error('lokasi') border-danger @enderror">
                                    <option value=""
                                        disabled
                                        selected>-- Pilih Lokasi --</option>
                                    @foreach ($lokasi as $l)
                                        <option value="{{ $l->id }}"
                                            {{ old('lokasi_id', @$mesin->lokasi_id) == $l->id ? 'selected' : '' }}>
                                            {{ $l->lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lokasi')
                                    <div id="lokasi"
                                        class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="tahun_pembuatan"
                                class="form-label">Tahun Pembuatan</label>
                            <input type="text"
                                name="tahun_pembuatan"
                                class="form-control @error('tahun_pembuatan') border-danger @enderror"
                                id="tahun_pembuatan"
                                value="{{ old('tahun_pembuatan', @$mesin->tahun_pembuatan) }}"
                                placeholder="2023">
                            @error('tahun_pembuatan')
                                <div id="tahun_pembuatan"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="periode_pakai"
                                class="form-label">Periode Pakai</label>
                            <input type="text"
                                name="periode_pakai"
                                class="form-control @error('periode_pakai') border-danger @enderror"
                                id="periode_pakai"
                                value="{{ old('periode_pakai', @$mesin->periode_pakai) }}"
                                placeholder="2025">
                            @error('periode_pakai')
                                <div id="periode_pakai"
                                    class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if ($method == 'update')
                            <input type="hidden"
                                name="type"
                                value="{{ @$_GET['type'] }}">
                            <div class="mb-3">
                                <label for="bulan"
                                    class="form-label">Bulan</label>
                                <select name="bulan"
                                    id="bulan"
                                    class="form-control @error('bulan') border-danger @enderror">
                                    <option value=""
                                        disabled
                                        selected>-- Pilih Bulan --</option>
                                    @foreach ($bulan as $b)
                                        <option value="{{ $b }}"
                                            {{ $b == bulanSaatIni() ? 'selected' : '' }}>
                                            {{ $b }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bulan')
                                    <div id="bulan"
                                        class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label class="form-label">Jenis Checklist</label>
                            <br>
                            <a href="{{ route('mesin.edit', $mesin->id) }}?type=harian"
                                class="btn {{ @$_GET['type'] == 'harian' ? 'btn-primary' : 'btn-outline-primary' }}">Harian</a>
                            <a href="{{ route('mesin.edit', $mesin->id) }}?type=mingguan"
                                class="btn {{ @$_GET['type'] == 'mingguan' ? 'btn-primary' : 'btn-outline-primary' }}">Mingguan</a>
                            <a href="{{ route('mesin.edit', $mesin->id) }}?type=bulanan"
                                class="btn {{ @$_GET['type'] == 'bulanan' ? 'btn-primary' : 'btn-outline-primary' }}">Bulanan</a>
                            <br><br>
                            <label class="form-label">Jenis Kegiatan</label>
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                            id="selectAll"
                                            type="checkbox">
                                    </td>
                                    <td>Centang Semua</td>
                                    <td></td>
                                </tr>
                                @foreach ($jeniskegiatan as $jk)
                                    @php
                                        $jeniskegiatanmesin = App\Models\JenisKegiatanMesin::where('mesin_id', @$mesin->id)
                                            ->where('jenis_kegiatan_id', $jk->id)
                                            ->where('bulan', @$_GET['bulan'] ?? bulanSaatIni())
                                            ->where('tahun', date('Y'))
                                            ->where('type', @$_GET['type'])
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td><input type="checkbox"
                                                name="jenis_kegiatan[]"
                                                value="{{ $jk->id }}"
                                                {{ $jeniskegiatanmesin ? 'checked' : '' }}></td>
                                        <td>{{ $jk->name }}</td>
                                        <td>{{ $jk->standart }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
                <button type="submit"
                    class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });
        </script>
    @endpush
</x-admin-layout>
