<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class DataBarangMasukController extends Controller
{
    public function Index()
    {
        $barang = BarangMasuk::with('barangs', 'detailMasuk')->orderBy('tanggal', 'asc')->get();
        return view('admin.barangMasuk.index', compact('barang'));
    }

    public function detail($id_detail_barang_masuk)
    {
        $barang = DetailBarangMasuk::where('id_detail_barang_masuk', $id_detail_barang_masuk)->with('barangs')->get();
        return view('admin.barangMasuk.detail', compact('barang'));
    }

    public function Create()
    {
        $kategori = BarangKeluar::get();
        $barang = barang::get();
        return view('admin.barangMasuk.create', compact('kategori', 'barang'));
    }
    public function CreatePost(Request $request)
    {
        $id_user = Auth::user()->id;

        // Validasi data
        $validatedData = $request->validate([
            'id_barang' => ['required', 'array'],
            'id_barang.*' => ['required'],
            'supplier' => ['required'],
            'barang' => ['required', 'array'],
            'barang.*' => ['required'],
            'qty' => ['required', 'array'],
            'qty.*' => ['required'],
            'harga' => ['required', 'array'],
            'harga.*' => ['required', 'numeric'],
            'tanggal' => ['required', 'array'],
            'tanggal.*' => ['required'],
        ]);

        foreach ($validatedData['id_barang'] as $key => $id_barang) {
            // Iterasi melalui setiap baris dan simpan sebagai data baru
            $Barang = barang::where('kode_barang', $id_barang)->first();
            $detail = DetailBarangMasuk::create([
                'nama_barang' => $Barang->nama_barang,
                'harga' => $validatedData['harga'][$key],
                'qty' => $validatedData['qty'][$key],

            ]);
            $idDetail = $detail->id_detail_barang_masuk;

            BarangMasuk::create([
                'kode_barang' => $id_barang,
                'id_detail_barang_masuk' => $idDetail,
                'supplier' => $validatedData['supplier'],
                'tanggal' => $validatedData['tanggal'][$key],
            ]);

            // Menambah qty di model Barang sesuai dengan qty yang dimasukkan oleh pengguna
            $dataBarang = Barang::findOrFail($id_barang);
            $dataBarang->increment('qty', $validatedData['qty'][$key]);
        }

        return redirect('barang-masuk')->with('success', 'Data Barang Masuk Sukses Ditambahkan');
    }
    public function Edit(Request $request, $id_barang_masuk)
    {
        $barangM = BarangMasuk::find($id_barang_masuk);
        $barang = barang::get();
        return view('admin.barangMasuk.edit', compact('barangM', 'barang'));
    }

    public function EditPost(Request $request, $id_barang_masuk)
    {
        $id_user = Auth::user()->id;
        $validatedData = $request->validate([
            'id_barang' => ['required'],
            'supplier' => ['required'],
            'barang' => ['required'],
            'qty' => ['required'],
            'harga' => ['required', 'numeric'],
            'tanggal' => ['required'],
        ]);

        $kode_barang = $request->id_barang;
        $nama_barang =  barang::where('kode_barang', $kode_barang)->first();

        // Mengupdate record yang sudah ditemukan
        BarangMasuk::where('id_barang_masuk', $id_barang_masuk)->update([
            'kode_barang' => $request->id_barang,
            'supplier' => $request->supplier,
            'tanggal' => $request->tanggal,
        ]);

        DetailBarangMasuk::where('id_detail_barang_masuk', $request->id_detail_barang_masuk)->update([
            'nama_barang' => $nama_barang->nama_barang,
            'harga' => $request->harga,
            'qty' => $request->qty,
        ]);

        // Mengurangi qty di model DataBarang sesuai dengan qty yang dimasukkan oleh pengguna
        $dataBarang = Barang::findOrFail($kode_barang);
        $dataBarang->increment('qty', $request->qty);

        return redirect('barang-masuk')->with('success', 'Data Barang Masuk Sukses Diubah');
    }

    public function Hapus(Request $request, $id_barang_masuk)
    {
        BarangMasuk::where('id_barang_masuk', '=', $id_barang_masuk)->delete();
        DetailBarangMasuk::where('id_detail_barang_masuk', '=', $request->id_detail_barang_masuk)->delete();
        return back()->with('success', 'Data Barang Masuk  Sukses Dihapus');
    }
}
