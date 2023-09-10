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
            border: 1px solid black !important;
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
            grid-template-columns: 2fr 1fr 2fr;
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

                        <td>Nama Peminta</td>
                        <td>:</td>
                        <td>{{ @$perbaikan->operator->name }}</td>
                    </tr>
                    <tr>
                        <td>Departement</td>
                        <td>:</td>
                        <td>{{ $perbaikan->lineproduksi->name }} & {{ $perbaikan->shift->name }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nama Mesin</td>
                        <td>:</td>
                        <td>{{ @$perbaikan->mesin->name }}</td>
                    </tr>
                    <tr>
                        <td>Type Mesin</td>
                        <td>:</td>
                        <td>{{ @$perbaikan->mesin->merk }}</td>
                    </tr>
                    <tr>
                        <td>No.PR/SPK</td>
                        <td>:</td>
                        <td>{{ @$perbaikan->mesin->merk }}</td>
                    </tr>
                </table>
            </div>
            <div class="item"
                style="text-align: center;">

            </div>
            <div class="item">
                <table class="table-dokumen"
                    border="0"
                    style="border-color: black;">
                    <tr>
                        <td>Tanggal Kerusakan</td>
                        <td>:</td>
                        <td>{{ substr($perbaikan->tanggal_request, 0, 10) }}</td>
                    </tr>
                    <tr>
                        <td>Mulai Pukul</td>
                        <td>:</td>
                        <td>{{ substr($perbaikan->tanggal_request, 10) }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Selesai</td>
                        <td>:</td>
                        <td>{{ substr($perbaikan->tanggal_update, 0, 10) }}</td>
                    </tr>
                    <tr>
                        <td>Selesai Pukul</td>
                        <td>:</td>
                        <td>{{ substr($perbaikan->tanggal_update, 10) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="ms-4 mt-5">
            <strong>Deskripsi Pekerjaan :</strong>
            <div class="border border-black p-2 mt-2">
                {{ $perbaikan->downtime }}
            </div>
        </div>
        <div class="ms-4 mt-4">
            <strong>Tindakan Perbaikan :</strong>
            <div class="border border-black p-2 mt-2">
                {{ $perbaikan->action }}
            </div>
        </div>
    </div>
</body>

</html>
