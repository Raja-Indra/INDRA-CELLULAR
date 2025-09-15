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
        Schema::table('produk_transaksi', function (Blueprint $table) {
            // Menambahkan kolom untuk jumlah produk setelah kolom 'produk_id'
            $table->integer('jumlah')->after('produk_id');

            // Menambahkan kolom untuk harga produk saat transaksi (opsional tapi direkomendasikan)
            $table->decimal('harga', 10, 2)->after('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_transaksi', function (Blueprint $table) {
            $table->dropColumn(['jumlah', 'harga']);
        });
    }
};
