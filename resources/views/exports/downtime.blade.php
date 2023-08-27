<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="9"
                    style="text-align: center;">
                    Downtime {{ $perawatan[0]->mesin->name }}
                </th>
            </tr>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
