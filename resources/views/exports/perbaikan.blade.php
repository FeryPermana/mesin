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
                    <div style="width: 200px;">
                        Status
                    </div>
                </th>
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
                    <td>
                        @if (@$perb->status == 3)
                            Waiting
                        @elseif(@$perb->status == 2)
                            Closed
                        @else
                            Open
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
