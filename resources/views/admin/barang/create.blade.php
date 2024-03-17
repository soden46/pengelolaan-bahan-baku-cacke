@extends('layouts.app',[
'title' => 'Form Data Barang',
'pageTitle' => 'Form Data Barang',
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
                <h1>Form Barang</h1>
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
                        <h3 class="card-title">Masukan Data Barang</h3>
                    </div>
                    <form id="quickForm" action="{{route('data-barang/create/store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-floating">
                                <label for="floatingInput">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control @error('kode_barang')is-invalid @enderror" id="kode_barang" placeholder="Masukan Kode Barang" required value="{{old('kode_barang')}}" onchange="reSum();">
                                @error('kode_barang')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <label for="floatingInput">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control @error('nama_barang')is-invalid @enderror" id="nama_barang" placeholder="Masukan Nama Barang" required value="{{old('nama_barang')}}" onchange="reSum();">
                                @error('nama_barang')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" class="form-control @error('satuan')is-invalid @enderror" id="satuan" placeholder="Masukan Satuan Barang" required value="{{old('satuan')}}" onchange="reSum();">
                                @error('satuan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">Qty</label>
                                <input type="text" name="Qty" class="form-control @error('Qty')is-invalid @enderror" id="Qty" placeholder="Masukan Qty" required value="{{old('Qty')}}" onchange="reSum();">
                                @error('Qty')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <label for="floatingInput">ID Kategori</label>
                                <select class="form-control @error('id_kategori')is-invalid @enderror" name="id_kategori" required id="id_kategori">
                                    <option value="option_select" disabled selected>ID Kategori</option>
                                    @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{$kat->id_kategori == $kat->id_kategori  ? 'selected' : ''}}>{{ $kat->nama_kategori}}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-2" type="submit">Simpan</button>
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