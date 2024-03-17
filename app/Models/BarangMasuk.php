<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    public $table = "barang_masuk";
    protected $guarded = [];
    protected $primaryKey = 'id_barang_masuk';
    public $timestamps = false;

    public function detailMasuk()
    {
        return $this->belongsTo(DetailBarangMasuk::class, 'id_detail_barang_masuk', 'id_detail_barang_masuk');
    }
    public function barangs()
    {
        return $this->belongsTo(barang::class, 'kode_barang', 'kode_barang');
    }
}
