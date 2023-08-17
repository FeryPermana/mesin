<table>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">
            <div style="width: 250px;">
                Jenis Kegiatan
            </div>
        </th>
        <th rowspan="2">
            <div style="text-align: center;">
                Standart
            </div>
        </th>
        <th colspan="31"
            style="text-align: center;">Pelaksanaan</th>
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
            <td style="text-align: center;">{{ $no++ }}</td>
            <td style="text-align: center;">{{ $j->name }}</td>
            <td style="text-align: center;">{{ $j->standart }}</td>
            @foreach ($pengerjaan as $p)
                @php
                    $checklists = $p->checklist;
                    
                    $arraycheck = [];
                    foreach ($checklists as $checklist) {
                        $arraycheck[] = $checklist->is_check ? $checklist->jenis_kegiatan_id : 0;
                    }
                @endphp
                @if (in_array($j->id, $arraycheck))
                    <td style="text-align: center;">v</td>
                @else
                    <td style="text-align: center;">-</td>
                @endif
            @endforeach
            @php
                $p = 32 - count($pengerjaan);
            @endphp
            @for ($i = 1; $i < $p; $i++)
                <td style="text-align: center;">-</td>
            @endfor
        </tr>
    @endforeach
    <tr>
        <td colspan="2"
            style="text-align: center;"><strong>Dikerjakan</strong></td>
        <td style="text-align: center;">Operator</td>
        @foreach ($pengerjaan as $p)
            <td style="text-align: center;"><i>{{ $p->operator->name }}</i></td>
            @php
                $p = 32 - count($pengerjaan);
            @endphp
        @endforeach
        @for ($i = 1; $i < $p; $i++)
            <td style="text-align: center;">-</td>
        @endfor
    </tr>
</table>
