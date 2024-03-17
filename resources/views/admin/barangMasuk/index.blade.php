@extends('layouts.app',[
'title' => 'Data Barang Masuk',
'pageTitle' => 'Data Barang Masuk'
])
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tabel Data Barang Masuk</h1>
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
                    <h3 class="card-title">Data Barang Masuk</h3>
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
                        <a class="btn btn-primary mb-3" href="{{route('barang-masuk/create')}}"><i class="fas fa-fw fa-plus"></i>Tambah</a>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Kode Barang: activate to sort column ascending">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Kode Barang: activate to sort column ascending">Kode Barang</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Nama Barang: activate to sort column ascending">Supplier</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Tanggal: activate to sort column ascending">Tanggal</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Aksi: activate to sort column ascending">Detail</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering Aksi: activate to sort column ascending">Aksi</th>
                                        </tr>
                                    </thead>
                                    @foreach($barang as $key => $brg)
                                    <tbody>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$brg->kode_barang ?? ''}}</td>
                                        <td>{{$brg->supplier ?? ''}}</td>
                                        <td>{{date('d/m/Y',strtotime($brg->tanggal))}}</td>
                                        <td>
                                            <div class="btn-group" style="width:135px">
                                                <a href="{{route('barang-masuk/detail',$brg->id_detail_barang_masuk)}}"><button class="btn btn-success">Lihat</button></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" style="width:135px">
                                                <form action="{{ route('barang-masuk/hapus',$brg->id_barang_masuk) }}" method="POST">
                                                    <a class="btn btn-primary" href="{{ route('barang-masuk/edit',$brg->id_barang_masuk) }}">Edit</a>
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        </tr>
                                    </tbody>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.js')
@endsection