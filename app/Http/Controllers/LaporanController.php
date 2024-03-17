<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function Index(Request $request)
    {
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        if (!empty($request["start_date"]) && !empty($request["end_date"])) {
            $laporan = DB::table('laporan_transaksi as a')
                ->select('a.*')
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->where('a.tanggal_keluar', '<=', $end_date)
                ->where('a.tanggal_keluar', '<=', $end_date)
                ->paginate(5);

            $barang = barang::get();
            return view('admin.Laporan.laporan', compact('laporan', 'barang'));
        } elseif (!empty($request["start_date"]) && empty($request["end_date"])) {
            $laporan = DB::table('laporan_transaksi as a')
                ->select('a.*')
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->paginate(5);

            $barang = barang::get();
            return view('admin.Laporan.laporan', compact('laporan', 'barang'));
        } else {
            $laporan = DB::table('laporan_transaksi as a')
                ->select('a.*')
                ->paginate(5);

            $barang = barang::get();
            return view('admin.Laporan.laporan', compact('laporan', 'barang'));
        }
    }

    public function PDF(Request $request)
    {
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        if (!empty($request["start_date"]) && !empty($request["end_date"])) {
            $laporan = DB::table('laporan_transaksi as a')
                ->select('a.*')
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->where('a.tanggal_keluar', '<=', $end_date)
                ->where('a.tanggal_keluar', '<=', $end_date)
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->format('d/m/Y');
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.Laporan', compact('laporan', 'tgl'))->setPaper('a4', 'landscape');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        } elseif (!empty($request["start_date"]) && empty($request["end_date"])) {
            $laporan = DB::table('laporan_transaksi as a')
                ->select('a.*')
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->where('a.tanggal_masuk', '>=', $start_date)
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->format('d/m/Y');
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.Laporan', compact('laporan', 'tgl'))->setPaper('a4', 'landscape');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        } else {
            $laporan = DB::table('laporan_transaksi as a')
                ->select('a.*')
                ->get();

            $currentTime = Carbon::now();
            $tgl = $currentTime->format('d/m/Y');
            $pdfPengiriman = FacadePdf::loadView('admin.Laporan.PDF.Laporan', compact('laporan', 'tgl'))->setPaper('a4', 'landscape');
            return $pdfPengiriman->stream('laporan' . '.pdf');
        }
    }
}
