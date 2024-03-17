<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanStokBarangController extends Controller
{
    public function Index(Request $request)
    {
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        if (!empty($request["start_date"]) && !empty($request["end_date"])) {
            $laporan = DB::table('laporan_stok_barang as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang', 'c.nama_kategori')
                ->join('barang as b', 'a.kode_barang', '=', 'b.kode_barang')
                ->join('kategori as c', 'a.id_kategori', '=', 'c.id_kategori')
                ->where('a.tanggal', '>=', $start_date)
                ->where('a.tanggal', '<=', $end_date)
                ->paginate(5);

            $barang = barang::get();
            return view('admin.Laporan.stok', compact('laporan', 'barang'));
        } elseif (!empty($request["start_date"]) && empty($request["end_date"])) {
            $laporan = DB::table('laporan_stok_barang as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang', 'c.nama_kategori')
                ->join('barang as b', 'a.kode_barang', '=', 'b.kode_barang')
                ->join('kategori as c', 'a.id_kategori', '=', 'c.id_kategori')
                ->where('a.tanggal', '>=', $start_date)
                ->paginate(5);

            $barang = barang::get();
            return view('admin.Laporan.stok', compact('laporan', 'barang'));
        } else {
            $laporan = DB::table('laporan_stok_barang as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang', 'c.nama_kategori')
                ->join('barang as b', 'a.kode_barang', '=', 'b.kode_barang')
                ->join('kategori as c', 'a.id_kategori', '=', 'c.id_kategori')
                ->paginate(5);

            $barang = barang::get();
            return view('admin.Laporan.stok', compact('laporan', 'barang'));
        }
    }
    public function PDF(Request $request)
    {
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        if (!empty($request["start_date"]) && !empty($request["end_date"])) {
            $laporan = DB::table('laporan_stok_barang as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang', 'c.nama_kategori')
                ->join('barang as b', 'a.kode_barang', '=', 'b.kode_barang')
                ->join('kategori as c', 'a.id_kategori', '=', 'c.id_kategori')
                ->where('a.tanggal', '>=', $start_date)
                ->where('a.tanggal', '<=', $end_date)
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->toDateString();
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.Barang', compact('laporan', 'tgl'))->setPaper('a4', 'portrait');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        } elseif (!empty($request["start_date"]) && empty($request["end_date"])) {
            $laporan = DB::table('laporan_stok_barang as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang', 'c.nama_kategori')
                ->join('barang as b', 'a.kode_barang', '=', 'b.kode_barang')
                ->join('kategori as c', 'a.id_kategori', '=', 'c.id_kategori')
                ->where('a.tanggal', '>=', $start_date)
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->toDateString();
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.Barang', compact('laporan', 'tgl'))->setPaper('a4', 'portrait');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        } else {
            $laporan = DB::table('laporan_stok_barang as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang', 'c.nama_kategori')
                ->join('barang as b', 'a.kode_barang', '=', 'b.kode_barang')
                ->join('kategori as c', 'a.id_kategori', '=', 'c.id_kategori')
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->toDateString();
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.Barang', compact('laporan', 'tgl'))->setPaper('a4', 'portrait');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        }
    }
}
