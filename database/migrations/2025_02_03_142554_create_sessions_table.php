<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('sessions', function (Blueprint $table) {
        $table->string('id')->primary();
        $table->string('user_id')->nullable();  // Pastikan user_id bertipe string
        $table->text('payload');
        $table->integer('last_activity');
        $table->text('user_agent')->nullable();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }

};
