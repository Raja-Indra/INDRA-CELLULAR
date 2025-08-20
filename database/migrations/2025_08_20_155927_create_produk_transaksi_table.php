<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_transaksi', function (Blueprint $table) {
            $table->id();

            // Foreign key untuk tabel transaksis (tipe data string).
            $table->string('transaksi_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');

            // PERBAIKAN: Mengubah tipe data 'produk_id' menjadi string agar cocok
            // dengan kolom 'id' di tabel 'produks'.
            $table->string('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_transaksi');
    }
};
