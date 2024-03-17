<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class GetDataBarangController extends Controller
{
    public function getNamaBarang($id)
    {
        $barang = barang::where('kode_barang', $id)->first();

        if ($barang) {
            return response()->json($barang->nama_barang);
        } else {
            return response()->json(['error' => 'Data barang tidak ditemukan'], 404);
        }
    }

    public function getBarangNama($id)
    {
        // Mengambil data barang berdasarkan id
        $barang = Barang::findOrFail($id);

        // Mengembalikan data barang dalam format JSON
        return response()->json([$barang->id => $barang->nama_barang]);
    }
}
