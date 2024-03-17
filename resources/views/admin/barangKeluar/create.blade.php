@extends('layouts.app',[
'title' => 'Form Data Barang Keluar',
'pageTitle' => 'Form Data Barang Keluar',
])
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Form Barang Keluar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Masukan Data Barang Keluar</h3>
                    </div>
                    <form id="quickForm" action="{{route('barang-keluar/create/post')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-floating-mt-2">
                                <table class="table table-bordered" id="myTable2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kode Barang</th>
                                            <th class="text-center">Nama Barang</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody2">
                                        <tr id="R2">
                                            <td class="row-index">
                                                <select class="form-control @error('id_barang')is-invalid @enderror" name="id_barang[]" required id="id_barang">
                                                    <option value="option_select" disabled selected>Kode Barang</option>
                                                    @foreach($barang as $bar)
                                                    <option value="{{ $bar->kode_barang }}" {{$bar->kode_barang == $bar->kode_barang  ? 'selected' : ''}}>{{ $bar->kode_barang}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_barang')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                            <td class="row-index">
                                                <select class="form-control @error('barang') is-invalid @enderror" name="barang[]" id="barang" required>
                                                    <option value="" selected>Nama Barang</option>
                                                    @foreach($barang as $bar)
                                                    <option value="{{$bar->nama_barang}}" {{ $bar->nama_barang == $bar->nama_barang  ? 'selected' : '' }}>{{ $bar->nama_barang }}</option>
                                                    @endforeach
                                                </select>
                                                @error('barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </td>
                                            <td class="row-index">
                                                <input type="number" name="qty[]" class="form-control @error('qty')is-invalid @enderror" id="qty" placeholder="Masukan Qty Barang" required value="{{old('qty')}}">
                                                @error('qty')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                            <td class="row-index">
                                                <input type="date" name="tanggal[]" class="form-control @error('tanggal')is-invalid @enderror" id="tanggal" placeholder="Masukan tanggal" required value="{{old('tanggal')}}">
                                                @error('tanggal')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm mb-3" id="addBtn2" type="button"><i class="fas fa-plus"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-floating mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="karyawan" class="col-form-label">Karyawan</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="karyawan" class="form-control @error('karyawan')is-invalid @enderror" id="karyawan" placeholder="Masukan karyawan" required value="{{old('karyawan')}}">
                                        @error('karyawan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary mt-2" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.js')
<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
@endsection