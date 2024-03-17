@extends('layouts.app',[
'title' => 'Detail Barang Masuk',
'pageTitle' => 'Detail Barang Masuk',
])
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Barang Masuk</h1>
    </div>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item"><a href="{{route('barang-masuk/index')}}">Kembali</a></li>
    </ol>
    <div class="card" style="width: 100%; height: 100%; background-color: white; padding: 20px">
        <!-- Modal Show Lampiran-->
        <div class="container">

            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Kode Barang: activate to sort column ascending">No</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Kode Barang: activate to sort column ascending">Nama Barang</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Nama Barang: activate to sort column ascending">Harga</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Tanggal: activate to sort column ascending">Qty</th>
                    </tr>
                </thead>
                @foreach($barang as $key => $brg)
                <tbody>
                    <td>{{ $key + 1 }}</td>
                    <td>{{$brg->nama_barang ?? ''}}</td>
                    <td>{{$brg->harga ?? ''}}</td>
                    <td>{{$brg->qty ?? ''}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</main>
@endsection