<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $table = "kategori";
    protected $guarded = [];
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
    public $timestamps = false;
}
