<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function Index()
    {
        $kategori = Kategori::get();
        $barang = barang::get();
        return view('admin.kategori.index', compact('kategori', 'barang'));
    }
    public function Create()
    {
        $kategori = Kategori::get();
        $id_user = Auth::User()->id;
        return view('admin.kategori.create', compact('kategori', 'id_user'));
    }
    public function CreatePost(Request $request)
    {
        $ValidatedData = $request->validate([
            'nama_kategori' => ['required']
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect('kategori')->with('success', 'Data Kategori Sukses Ditambahkan');
    }
    public function Edit(Request $request, $id_kategori)
    {
        $kategori = Kategori::find($id_kategori);
        return view('admin.kategori.edit', compact('kategori'));
    }
    public function EditPost(Request $request, $id_kategori)
    {
        $ValidatedData = $request->validate([
            'nama_kategori' => ['required'],
        ]);

        Kategori::find($id_kategori)->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect('kategori')->with('success', 'Data Kategori Sukses Diubah');
    }
    public function Hapus(Request $request, $id_kategori)
    {
        Kategori::where('id_kategori', '=', $id_kategori)->delete();
        return back()->with('success', 'Data Kategori Sukses Ditambahkan');
    }
}
