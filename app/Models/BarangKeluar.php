<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class BarangKeluar extends Model
{
    public $table = "barang_keluar";
    protected $guarded = [];
    protected $primaryKey = 'id_barang_keluar';
    public $timestamps = false;

    public function detailKeluar()
    {
        return $this->belongsTo(DetailBarangKeluar::class, 'id_detail_barang_keluar', 'id_detail_barang_keluar');
    }
    public function barangs()
    {
        return $this->belongsTo(barang::class, 'kode_barang', 'kode_barang');
    }
}
