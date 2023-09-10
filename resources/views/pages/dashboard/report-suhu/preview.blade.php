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
        <div class="grid-container"
            style="margin-bottom: -30px;">
            <div class="item">
                <img src="{{ asset('assets/images/logos/tanobel-logo-w300.png') }}"
                    alt=""
                    width="180">
            </div>
            <div class="item"
                style="text-align: center;">

            </div>
            <div class="item">
                <div class="border border-dark p-2">
                    <table class="table-dokumen"
                        border="0"
                        style="border-color: white;">
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
        </div>
        <div class="text-center mt-5">
            <h4>CATATAN MONITORING SUHU DAN KELEMBAPAN</h4>
        </div>
        <div class="grid-container"
            style="margin-bottom: -30px;">
            <div class="item">
                <table class="table-dokumen"
                    border="0"
                    style="border-color: white;">
                    <tr>
                        @php
                            $date = new DateTime($pengerjaan[0]->tanggal ?? '');
                            $monthYearString = generateMonthYearStringFromDate($date);
                        @endphp
                        <td>Bulan</td>
                        <td>:</td>
                        <td>{{ @$_GET['bulan'] }} {{ @$_GET['tahun'] }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td>AMDK 1</td>
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
