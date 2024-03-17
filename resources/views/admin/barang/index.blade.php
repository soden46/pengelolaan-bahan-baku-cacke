@extends('layouts.app',[
'title' => 'Data Barang',
'pageTitle' => 'Data Barang'
])
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tabel Data Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content d-flex justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Barang</h3>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <a class="btn btn-primary mb-3" href="{{route('data-barang/create')}}"><i class="fas fa-fw fa-plus"></i>Tambah</a>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering ID Barang: activate to sort column descending">Kode Barang</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Nama Barang: activate to sort column ascending">Nama Barang</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Satuan: activate to sort column ascending">Satuan</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Qty: activate to sort column ascending">Qty</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Aksi: activate to sort column ascending">Aksi</th>
                                        </tr>
                                    </thead>
                                    @foreach($barang as $brg)
                                    <tbody>
                                        <td>{{$brg->kode_barang}}</td>
                                        <td>{{$brg->nama_barang}}</td>
                                        <td>{{$brg->satuan}}</td>
                                        <td>{{$brg->qty}}</td>
                                        <td>
                                            <div class="btn-group" style="width:135px">
                                                <form action="{{ route('data-barang/hapus',$brg->kode_barang) }}" method="POST">
                                                    <a class="btn btn-primary" href="{{ route('data-barang/edit',$brg->kode_barang) }}">Edit</a>
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tbody>
                                </table>


                                @endsection