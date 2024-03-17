<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat view laporan_transaksi
        DB::statement("
            CREATE VIEW laporan_transaksi AS
            SELECT
                b.kode_barang AS kode_barang,
                b.nama_barang AS nama_barang,
                COALESCE(SUM(detail_masuk.qty), 0) AS barang_masuk,
                COALESCE(SUM(detail_keluar.qty), 0) AS barang_keluar,
                b.qty as qty_barang,
                (COALESCE(SUM(detail_masuk.qty), 0) - COALESCE(SUM(detail_keluar.qty), 0)) AS stok,
                MAX(masuk.tanggal) AS tanggal_masuk,
                MAX(keluar.tanggal) AS tanggal_keluar,
                MAX(detail_masuk.harga) AS harga,
                (COALESCE(SUM(detail_masuk.qty), 0) * MAX(detail_masuk.harga)) AS total_harga
            FROM
                barang b
            LEFT JOIN
                barang_masuk masuk ON b.kode_barang = masuk.kode_barang
            LEFT JOIN
                detail_barang_masuk detail_masuk ON masuk.id_detail_barang_masuk = detail_masuk.id_detail_barang_masuk
            LEFT JOIN
                barang_keluar keluar ON b.kode_barang = keluar.kode_barang
            LEFT JOIN
                detail_barang_keluar detail_keluar ON keluar.id_detail_barang_keluar = detail_keluar.id_detail_barang_keluar
            GROUP BY
                b.kode_barang, b.nama_barang, b.qty
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Menghapus view laporan_transaksi
        DB::statement("DROP VIEW IF EXISTS laporan_transaksi");
    }
};
