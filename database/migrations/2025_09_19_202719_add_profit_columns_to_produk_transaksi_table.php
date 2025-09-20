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
            // Mengubah nama kolom 'harga' menjadi 'harga_jual' untuk kejelasan.
            // Catatan: Ini memerlukan paket doctrine/dbal: composer require doctrine/dbal
            $table->renameColumn('harga', 'harga_jual');

            // Menambahkan kolom untuk harga modal dan keuntungan setelah harga_jual
            $table->decimal('harga_modal', 10, 2)->after('harga_jual');
            $table->decimal('keuntungan', 10, 2)->after('harga_modal');
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
            // Urutan dibalik untuk rollback
            $table->dropColumn('keuntungan');
            $table->dropColumn('harga_modal');
            $table->renameColumn('harga_jual', 'harga');
        });
    }
};