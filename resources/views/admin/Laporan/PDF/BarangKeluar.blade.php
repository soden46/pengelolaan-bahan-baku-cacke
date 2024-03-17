<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
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

        .table {
            width: 100%;
            border-collapse: collapse;
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
            margin-left: 400px;

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
                    <h1 class="text-center">Laporan Penjualan</h1>
                </h1>
            </div>
            <table class=" table table-bordered" style="table-layout: fixed">
                <tr class="font-12">
                    <th style="width: 90px">Kode Barang</th>
                    <th style="width: 90px">Nama Barang</th>
                    <th style="width: 90px">Harga</th>
                    <th style="width: 200px">Qty</th>
                    <th style="width: 200px">Tanggal</th>
                </tr>
                @foreach ($laporan as $data)
                <tr>
                    <td>{{ $data->kode_barang }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->harga}}</td>
                    <td>{{ $data->qty}}</td>
                    <td>{{ $data->tanggal }}</td>
                </tr>
                @endforeach
            </table>
            <div class=" tandatangan">

                <br>

                <p style="padding-bottom:25px">
                    Kota, {!!$tgl!!}</p>


                <p>{{Auth::user()->nama}}</p>
            </div>
        </div>
    </div>
</body>

</html>