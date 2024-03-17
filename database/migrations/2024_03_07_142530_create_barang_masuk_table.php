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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->bigInteger('id_barang_masuk')->autoIncrement();
            $table->bigInteger('id_detail_barang_masuk');
            $table->string('kode_barang');
            $table->string('supplier');
            $table->date('tanggal');
            $table->foreign('id_detail_barang_masuk')->references('id_detail_barang_masuk')->on('detail_barang_masuk')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('kode_barang')->references('kode_barang')->on('barang')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
