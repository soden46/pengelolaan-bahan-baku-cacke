<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <style>
        body {
            font-size: 12px;
            font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }

        .table,
        .td,
        .th,
        thead {
            border: 1px solid black;
            text-align: center
        }

        .text-center {
            text-align: center;
        }

        .text-success {
            color: green
        }

        .text-danger {
            color: red
        }

        .fw-bold {
            font-weight: bold
        }

        .tandatangan {

            text-align: center;
            margin-left: 500px;

        }

        .header img {
            float: left;
            width: 100px;
            height: 100px;
            background: transparent;
        }

        .header h1 {
            font-size: 18px;
            font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
            position: relative;
            top: 5px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div class="header mb-3">
                <img src="{{ public_path('storage/syarifsoden.png') }}" alt="" width="42px" height="42px" />
                <h1 class="text-center">Toko Kue<br>
                    <P class="text-center">Jl</P>
                    <h1 class="text-center">Laporan Transaksi</h1>
                </h1>
            </div>
            <div class="table-responsive">
                <table id="dataTable" name="dataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Barang Masuk</th>
                            <th>Barang Keluar</th>
                            <th>Qty Barang</th>
                            <th>Stok</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->kode_barang }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->barang_masuk}}</td>
                            <td>{{ $data->barang_keluar}}</td>
                            <td>{{ $data->qty_barang}}</td>
                            <td>{{ $data->stok}}</td>
                            <td>{{ date('d/m/Y',strtotime($data->tanggal_masuk ?? 'Belum Ada Barang Masuk'))}}</td>
                            <td>{{ date('d/m/Y',strtotime($data->tanggal_keluar ?? 'Belum Ada Barang Keluar'))}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class=" tandatangan">
                <br>
                <p style="padding-bottom:25px">Kota, {!!$tgl!!}</p>
                <p>{{Auth::user()->nama}}</p>
            </div>
        </div>
    </div>
</body>


</html>