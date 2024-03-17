<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $table = "laporan";
    protected $fillable = [
        'kode_kategori',
        'kode_jenis',
        'nama_barang',
        'jumlah',
        'Satuan',
        'harga',
        'tanggal',
    ];
    public $timestamps = false;
}
