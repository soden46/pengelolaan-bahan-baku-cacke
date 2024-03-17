<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    use HasFactory;

    public $table = "detail_barang_masuk";
    protected $guarded = [];
    protected $primaryKey = 'id_detail_barang_masuk';
    public $timestamps = false;

    public function barangs()
    {
        return $this->belongsTo(barang::class, 'kode_barang', 'kode_barang');
    }
}
