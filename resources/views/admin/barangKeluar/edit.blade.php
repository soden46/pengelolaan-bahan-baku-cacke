@extends('layouts.app',[
'title' => 'Form Barang Keluar',
'pageTitle' => 'Form Barang Keluar',
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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                    <form id="quickForm" action="{{route('barang-keluar/edit/post',$barangK->id_barang_keluar)}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-floating">
                                <label for="floatingInput">Kode Barang</label>
                                <select class="form-control @error('id_barang')is-invalid @enderror" name="id_barang" required id="id_barang">
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
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">Nama Barang</label>
                                <select class="form-control @error('barang') is-invalid @enderror" name="barang" id="barang" required>
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
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">Karyawan</label>
                                <input type="text" name="karyawan" class="form-control @error('karyawan')is-invalid @enderror" id="karyawan" placeholder="Masukan Nama Karyawan" required value="{{$barangK->karyawan}}">
                                @error('karyawan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">QTY</label>
                                <input type="number" name="qty" class="form-control @error('qty')is-invalid @enderror" id="qty" placeholder="Masukan QTY Barang" required value="{{$barangK->detailKeluar->qty}}">
                                @error('qty')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal')is-invalid @enderror" id="tanggal" placeholder="Masukan tanggal" required value="{{$barangK->tanggal ?? ''}}">
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-12" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection