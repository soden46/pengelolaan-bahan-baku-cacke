<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class LaporanBarangKeluarController extends Controller
{
    public function Index(Request $request)
    {
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        if (!empty($request["start_date"]) && !empty($request["end_date"])) {
            $laporan = DB::table('laporan_barang_keluar as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang',  'd.nama')
                ->join('barang as b', 'a.kode_barang', '=', 'b.kode_barang')
                ->where('a.tanggal', '>=', $start_date)
                ->where('a.tanggal', '<=', $end_date)
                ->paginate(5);

            return view('admin.Laporan.keluar', compact('laporan'));
        } elseif (!empty($request["start_date"]) && empty($request["end_date"])) {
            $laporan = DB::table('laporan_barang_keluar as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang',  'd.nama')
                ->join('barang as b', 'a.id_barang', '=', 'b.kode_barang')
                ->where('a.tanggal', '>=', $start_date)
                ->paginate(5);

            return view('admin.Laporan.keluar', compact('laporan'));
        } else {
            $laporan = DB::table('laporan_barang_keluar as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang',  'd.nama')
                ->join('barang as b', 'a.id_barang', '=', 'b.kode_barang')
                ->paginate(5);

            return view('admin.Laporan.keluar', compact('laporan'));
        }
    }
    public function PDF(Request $request)
    {
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        if (!empty($request["start_date"]) && !empty($request["end_date"])) {
            $laporan = DB::table('laporan_barang_keluar as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang',  'd.nama')
                ->join('barang as b', 'a.id_barang', '=', 'b.kode_barang')
                ->where('a.tanggal', '>=', $start_date)
                ->where('a.tanggal', '<=', $end_date)
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->toDateString();
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.BarangKeluar', compact('laporan', 'tgl'))->setPaper('a4', 'portrait');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        } elseif (!empty($request["start_date"]) && empty($request["end_date"])) {
            $laporan = DB::table('laporan_barang_keluar as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang',  'd.nama')
                ->join('barang as b', 'a.id_barang', '=', 'b.kode_barang')
                ->where('a.tanggal', '>=', $start_date)
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->toDateString();
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.BarangKeluar', compact('laporan', 'tgl'))->setPaper('a4', 'portrait');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        } else {
            $laporan = DB::table('laporan_barang_keluar as a')
                ->select('a.*', 'b.kode_barang', 'b.nama_barang',  'd.nama')
                ->join('barang as b', 'a.id_barang', '=', 'b.kode_barang')
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->toDateString();
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.BarangKeluar', compact('laporan', 'tgl'))->setPaper('a4', 'portrait');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        }
    }
}
