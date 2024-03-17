<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarangKeluar;
use App\Models\DetailBarangKeluar;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class DataBarangKeluarController extends Controller
{
    public function Index()
    {
        $barangk = BarangKeluar::with('barangs', 'detailKeluar')->orderBy('tanggal', 'asc')->get();
        return view('admin.barangKeluar.index', compact('barangk'));
    }

    public function detail($id_detail_barang_keluar)
    {
        $barang = DetailBarangKeluar::where('id_detail_barang_keluar', $id_detail_barang_keluar)->with('barangs')->get();
        return view('admin.barangKeluar.detail', compact('barang'));
    }

    public function Create()
    {
        $kategori = BarangKeluar::get();
        $barang = barang::get();
        return view('admin.barangKeluar.create', compact('kategori', 'barang'));
    }
    public function CreatePost(Request $request)
    {

        // Validasi data
        $validatedData = $request->validate([
            'id_barang' => ['required', 'array'],
            'id_barang.*' => ['required'],
            'karyawan' => ['required'],
            'barang' => ['required', 'array'],
            'barang.*' => ['required'],
            'qty' => ['required', 'array'],
            'qty.*' => ['required'],
            'tanggal' => ['required', 'array'],
            'tanggal.*' => ['required'],
        ]);

        // Iterasi melalui setiap baris dan simpan sebagai data baru
        foreach ($validatedData['id_barang'] as $key => $id_barang) {
            $Barang = barang::where('kode_barang', $id_barang)->first();
            $detail = DetailBarangKeluar::create([
                'nama_barang' => $Barang->nama_barang,
                'qty' => $validatedData['qty'][$key],

            ]);
            $idDetail = $detail->id_detail_barang_keluar;
            BarangKeluar::create([
                'id_detail_barang_keluar' => $idDetail,
                'kode_barang' => $id_barang,
                'karyawan' => $validatedData['karyawan'],
                'tanggal' => $validatedData['tanggal'][$key],
            ]);

            // Menambah qty di model Barang sesuai dengan qty yang dimasukkan oleh pengguna
            $dataBarang = Barang::findOrFail($id_barang);
            $dataBarang->decrement('qty', $validatedData['qty'][$key]);
        }
        return redirect('barang-keluar')->with('success', 'Data Barang Keluar Sukses Ditambahkan');
    }
    public function Edit(Request $request, $id_barang_keluar)
    {
        $barangK = BarangKeluar::with('detailKeluar')->find($id_barang_keluar);
        $barang = barang::get();
        return view('admin.barangKeluar.edit', compact('barangK', 'barang'));
    }
    public function EditPost(Request $request, $id_barang_keluar)
    {
        $id_user = Auth::User()->id;
        $ValidatedData = $request->validate([
            'id_barang' => ['required'],
            'qty' => ['required', 'numeric'],
            'tanggal' => ['required'],
            'karyawan' => ['required'],
        ]);


        $kode_barang = $request->id_barang;
        $nama_barang =  barang::where('kode_barang', $kode_barang)->first();

        BarangKeluar::where('id_barang_keluar', $id_barang_keluar)->update([
            'kode_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'karyawan' => $request->karyawan,
        ]);

        DetailBarangKeluar::where('id_detail_barang_keluar', $request->id_detail_barang_keluar)->update([
            'nama_barang' => $nama_barang->nama_barang,
            'qty' => $request->qty,
        ]);

        // Mengurangi qty di model DataBarang sesuai dengan qty yang dimasukkan oleh pengguna
        Barang::where('kode_barang', $kode_barang)
            ->decrement('qty', $request->qty);

        return redirect('barang-keluar')->with('success', 'Data Barang Keluar Sukses Diubah');
    }
    public function Hapus(Request $request, $id_barang_keluar)
    {
        BarangKeluar::where('id_barang_keluar', '=', $id_barang_keluar)->delete();
        return back()->with('success', 'Data Barang Keluar  Sukses Dihapus');
    }
}
