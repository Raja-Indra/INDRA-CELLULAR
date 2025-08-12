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
        Schema::create('produks', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sebagai string dan primary key
            $table->string('provider_id'); // Kolom provider_id, tipe data string
            $table->foreign('provider_id')  // Mendefinisikan relasi ke kolom id di tabel providers
                  ->references('id')         // Kolom yang menjadi referensi (id) di tabel providers
                  ->on('providers')          // Nama tabel yang menjadi referensi
                  ->onDelete('cascade');     // Aksi ketika data di tabel providers dihapus
            $table->string('nama_produk'); // Nama produk (contoh: Pulsa 10.000, Paket 1GB)
            $table->decimal('harga_modal', 10, 2); // Harga modal produk
            $table->decimal('harga_jual', 10, 2); // Harga jual produk
            $table->integer('stok'); // Stok produk
            $table->enum('jenis', ['pulsa', 'paket_data', 'token_listrik']); // Jenis produk
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
