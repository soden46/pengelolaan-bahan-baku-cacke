@extends('layouts.app',[
'title' => 'Form Barang Masuk',
'pageTitle' => 'Form Barang Masuk',
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
                <h1>Form Barang Masuk</h1>
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
                        <h3 class="card-title">Masukan Data Barang Masuk</h3>
                    </div>
                    <form id="quickForm" action="{{route('barang-masuk/edit/post',$barangM->id_barang_masuk)}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-floating">
                                <label for="supplier">Supplier</label>
                                <input type="text" name="supplier" class="form-control @error('supplier')is-invalid @enderror" id="supplier" placeholder="Masukan Supplier" required value="{{$barangM->supplier ?? ''}}" onchange="reSum();">
                                @error('supplier')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

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
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" class="form-control @error('qty')is-invalid @enderror" id="qty" placeholder="Masukan Qty Barang" required value="{{$barangM->qty}}">
                                @error('qty')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">Harga</label>
                                <input type="number" name="harga" step="0.0" class="form-control @error('harga')is-invalid @enderror" id="harga" placeholder="Masukan harga" required value="{{$barangM->harga}}">
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal')is-invalid @enderror" id="tanggal" placeholder="Masukan tanggal" required value="{{$barangM->tanggal ?? ''}}">
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
<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
<script>
    function reSum() {
        var num1 = parseInt(document.getElementById("harga").value);
        var num2 = parseInt(document.getElementById("biaya_pengiriman").value);
        document.getElementById("sub_total_pengiriman").value = num1 + num2;

    }
</script>
@endsection