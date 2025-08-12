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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sebagai string dan primary key
            $table->string('user_id'); // Kolom user_id, tipe data string
            $table->foreign('user_id')  // Mendefinisikan relasi ke kolom id di tabel users
                  ->references('id')         // Kolom yang menjadi referensi (id) di tabel users
                  ->on('users')          // Nama tabel yang menjadi referensi
                  ->onDelete('cascade');     // Aksi ketika data di tabel users dihapus
            $table->string('produk_id'); // Kolom produk_id, tipe data string
            $table->foreign('produk_id')  // Mendefinisikan relasi ke kolom id di tabel produks
                  ->references('id')         // Kolom yang menjadi referensi (id) di tabel produks
                  ->on('produks')          // Nama tabel yang menjadi referensi
                  ->onDelete('cascade');     // Aksi ketika data di tabel produks dihapus
            $table->string('nomor_pelanggan'); // Nomor handphone atau meteran listrik
            $table->decimal('total_harga', 10, 2); // Total harga transaksi
            $table->enum('status', ['sukses', 'pending', 'gagal'])->default('pending'); // Status transaksi
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
