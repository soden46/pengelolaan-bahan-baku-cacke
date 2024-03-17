<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->bigInteger('id_barang_keluar')->autoIncrement();
            $table->bigInteger('id_detail_barang_keluar');
            $table->string('kode_barang');
            $table->string('karyawan');
            $table->date('tanggal');
            $table->foreign('id_detail_barang_keluar')->references('id_detail_barang_keluar')->on('detail_barang_keluar')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('kode_barang')->references('kode_barang')->on('barang')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
