<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Harian</title>

    <style>
        .container {
            width: 95%;
            margin: auto;
            border: 3px solid black;
            padding: 8px;
        }

        .table-hasil,
        .table-hasil td,
        .table-hasil th {
            border: 1px solid black;
        }

        .table-dokumen,
        .table-dokumen td,
        .table-dokumen th {
            border: 1px solid white;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            ;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            /* Membagi menjadi tiga kolom dengan lebar yang sama */
            gap: 10px;
            /* Jarak antara elemen-elemen */
        }

        .item {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="grid-container" style="margin-bottom: -30px;">
            <div class="item">
                <img src="{{ asset('assets/images/logos/tanobel-logo-w300.png') }}" alt="" width="100">
                @php
                $date = new DateTime($pengerjaan[0]->tanggal);
                $monthYearString = generateMonthYearStringFromDate($date);
                @endphp
                <p>Periode Bulan/Tahun : {{ $monthYearString }}<br>
                    <strong>{{ $shiftname }}</strong>
                </p>
            </div>
            <div class="item" style="text-align: center;">
                <h2>{{ $mesin->name }}</h2>
            </div>
            <div class="item">
                <table class="table-dokumen" border="0" style="border-color: white;">
                    <tr>
                        <td>No. Dokumen</td>
                        <td>:</td>
                        <td>FR-TEK-02-04</td>
                    </tr>
                    <tr>
                        <td>Tgl. Efektif</td>
                        <td>:</td>
                        <td>08-02-2017</td>
                    </tr>
                    <tr>
                        <td>Rev</td>
                        <td>:</td>
                        <td>0</td>
                    </tr>
                </table>
            </div>
        </div>
        <table class="table-hasil" width="200px;" style="margin: auto;">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">
                    <div style="width: 100px;">
                        Jenis Kegiatan
                    </div>
                </th>
                <th rowspan="2">
                    <div style="width: 60px;">
                        Standart
                    </div>
                </th>
                <th colspan="31" style="text-align: center;">Pelaksanaan</th>
            </tr>
            <tr>
                @for ($i = 1; $i < 32; $i++) <th>{{ $i }}</th>
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
                @for ($i = 1; $i < $p; $i++) <td style="text-align: center;">-</td>
                    @endfor
            </tr>
            @endforeach
            <tr>
                <td colspan="2"><strong>Dikerjakan</strong></td>
                <td>Operator</td>
                @foreach ($pengerjaan as $p)
                <td><i style="font-size: 8px;">{{ $p->operator->name }}</i></td>
                @php
                $p = 32 - count($pengerjaan);
                @endphp
                @endforeach
                @for ($i = 1; $i < $p; $i++) <td>-</td>
                    @endfor
            </tr>
        </table>
        <div style="display: flex; justify-content: space-between;">
            <div style="margin-top: 10px; width: 50%;">
                <strong>Note :</strong> <br>
                <ul>
                    <li>Beri tanda (v) jika sudah dilakukan, beri tanda (x). Jika libur atau mesin OFF</li>
                    <li>Ketika ada yang tidak sesuai standart. Lapor ke pihak teknisi jika Operator tidak bisa
                        memperbaiki
                        sendiri</li>
                </ul>
            </div>

            <div>
                <p style="text-align: center;">Mengetahui</p><br><br><br>

                <p>(Ka. Produksi) &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;
                    (Ka. Teknik)
                </p>
            </div>
        </div>
    </div>
</body>

</html>