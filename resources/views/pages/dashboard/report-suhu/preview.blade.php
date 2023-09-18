<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
    <title>Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous">

    <style>
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

        .table-dokumen td,
        .table-dokumen th {
            padding: 1px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
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
        <div class="row"
            style="margin-bottom: -30px;">
            <div class="col-6">
                <img src="{{ asset('assets/images/logos/tanobel-logo-w300.png') }}"
                    alt=""
                    width="180">
            </div>
            <div class="col-6">
                <div class="border border-dark p-2 mt-3">
                    <table class="table-dokumen"
                        border="0"
                        style="border-color: white;">
                        <tr>
                            <td style="font-size: 10px;">No. Dokumen</td>
                            <td style="font-size: 10px;">:</td>
                            <td style="font-size: 10px;">FR-TEK-02-04</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;">Tgl. Efektif</td>
                            <td style="font-size: 10px;">:</td>
                            <td style="font-size: 10px;">08-02-2017</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;">Rev</td>
                            <td style="font-size: 10px;">:</td>
                            <td style="font-size: 10px;">0</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <h6>CATATAN MONITORING SUHU DAN KELEMBAPAN</h6>
        </div>
        <div class="grid-container"
            style="margin-bottom: -30px;">
            <div class="item">
                <table class="table-dokumen"
                    border="0"
                    style="border-color: white;">
                    <tr>
                        @php
                            $date = new DateTime($monitoringsuhu[0]->tanggal ?? '');
                            $monthYearString = generateMonthYearStringFromDate($date);
                        @endphp
                        <td>Bulan</td>
                        <td>:</td>
                        <td>{{ @$_GET['bulan'] }} {{ @$_GET['tahun'] }}</td>
                    </tr>
                    <tr>
                        <td>Shift</td>
                        <td>:</td>
                        <td>{{ @$monitoringsuhu[0]->shift->name }}</td>
                    </tr>
                    <tr>
                        <td>Line Produksi</td>
                        <td>:</td>
                        <td>{{ @$monitoringsuhu[0]->lineproduksi->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="item"
                style="text-align: center;">

            </div>
            <div class="item">
                <table class="table-dokumen"
                    border="0"
                    style="border-color: white;">
                    <tr>
                        <td>Standar Suhu</td>
                        <td>:</td>
                        <td>25 <sup>o</sup></td>
                    </tr>
                    <tr>
                        <td>Standar RH</td>
                        <td>:</td>
                        <td> %</td>
                    </tr>
                </table>
            </div>
        </div>
        <table class="table-hasil mt-3">
            <thead>
                <tr>
                    <th rowspan="2"
                        class="text-center">No</th>
                    <th rowspan="2"
                        class="text-center">Tanggal</th>
                    <th colspan="2"
                        class="text-center">Hasil Pemeriksaan</th>
                    <th rowspan="2"
                        class="text-center">Petugas</th>
                    <th rowspan="2"
                        class="text-center">Keterangan</th>
                </tr>
                <tr>
                    <th class="text-center">Suhu (<sup>o</sup>C)</th>
                    <th class="text-center">RH (%)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($monitoringsuhu as $ms)
                    <tr class="text-center">
                        <td>{{ $no++ }}</td>
                        <td>{{ $ms->tanggal }}</td>
                        <td>{{ $ms->suhu }}</td>
                        <td>{{ $ms->rh }}</td>
                        <td>{{ $ms->operator->name }}</td>
                        <td>{{ $ms->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <p>Diverifikasi Oleh</p><br>

            <p>(Ka. Bag)
            </p>
        </div>
    </div>
</body>

</html>
