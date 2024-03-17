<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\barang;
use App\Models\Jenis;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    public function barangIndex()
    {
        $barang = barang::get();
        return view('admin.barang.index', compact('barang'));
    }
    public function barangCreate()
    {
        $kategori = Kategori::get();
        return view('admin.barang.create', compact('kategori'));
    }
    public function barangCreatePost(Request $request)
    {
        $ValidatedData = $request->validate([
            'kode_barang' => ['required'],
            'nama_barang' => ['required'],
            'satuan' => ['required'],
            'Qty' => ['required'],
            'id_kategori' => ['required']
        ]);

        barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'Qty' => $request->Qty,
            'id_kategori' => $request->id_kategori
        ]);
        return redirect('data-barang')->with('success', 'Data Barang Sukses Ditambahkan');
    }
    public function barangEdit(Request $request, $kode_barang)
    {
        $barang = barang::where('kode_barang', $kode_barang)->first();
        $kategori = Kategori::get();
        return view('admin.barang.edit', compact('barang', 'kategori'));
    }
    public function barangEditPost(Request $request, $kode_barang)
    {
        $kode_barang = $request->kode_barang;
        $ValidatedData = $request->validate([
            'kode_barang' => ['required'],
            'nama_barang' => ['required'],
            'satuan' => ['required'],
            'Qty' => ['required'],
            'id_kategori' => ['required']
        ]);

        barang::where('kode_barang', $kode_barang)->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'Qty' => $request->Qty,
            'id_kategori' => $request->id_kategori
        ]);
        return redirect('data-barang')->with('success', 'Data Barang Sukses Diubah');
    }
    public function barangHapus(Request $request, $kode_barang)
    {
        $kode_barang = $request->kode_barang;
        barang::where('kode_barang', '=', $kode_barang)->delete();
        return back()->with('success', 'Data Barang Sukses Ditambahkan');
    }
}
