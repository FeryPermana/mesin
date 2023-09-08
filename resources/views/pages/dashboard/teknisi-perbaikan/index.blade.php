<x-admin-layout>
    <div class="card">
        <div class="card-body">
            <div class="my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Request Perbaikan</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="">
                <div class="row">
                    <div class="col-md-3">
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
                    <div class="col-md-3">
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
                    <div class="col-md-3">
                        <select name="lineproduksi"
                            class="form-control custom-select">
                            <option value=""
                                selected>-- Line Produksi --</option>
                            @foreach ($lineproduksis as $linpr)
                                <option value="{{ $linpr->id }}"
                                    {{ @$_GET['lineproduksi'] == $linpr->id ? 'selected' : '' }}>
                                    {{ $linpr->name }}
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
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <div style="width: 200px;">
                                    Mesin
                                </div>
                            </th>
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
                                    Action Perbaikan
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px">
                                    Pergantian Spare
                                </div>
                            </th>
                            <th>Status</th>
                            <th>
                                <div style="width: 200px">
                                    Lama Waktu
                                </div>
                            </th>
                            <th>
                                <div style="width: 200px">
                                    Kerusakan
                                </div>
                            </th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perbaikan as $perb)
                            <tr>
                                <td>{{ $perb->mesin->name }}</td>
                                <td>{{ $perb->lineproduksi->name }}</td>
                                <td>{{ $perb->mesin->lokasi->lokasi }}</td>
                                <td>{{ $perb->shift->name }}</td>
                                <td>{{ $perb->tanggal_request }}</td>
                                <td>{{ $perb->tanggal_update }}</td>
                                <td>{{ $perb->action }}</td>
                                <td>{{ $perb->pergantian_spare }}</td>
                                <td>
                                    @if (@$perb->status == 3)
                                        Waiting
                                    @elseif(@$perb->status == 2)
                                        Closed
                                    @else
                                        Open
                                    @endif
                                </td>
                                <td>{{ $perb->lama_waktu }}</td>
                                <td>{{ $perb->downtime }}</td>
                                <td>
                                    <img src="{{ asset($perb->gambar) }}"
                                        alt=""
                                        width="100">
                                </td>
                                <td>
                                    <a href="{{ route('teknisi-perbaikan.edit', $perb->id) }}"
                                        class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
