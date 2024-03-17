<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    public $table = "barang";
    protected $primaryKey = 'kode_barang';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = false;
}
