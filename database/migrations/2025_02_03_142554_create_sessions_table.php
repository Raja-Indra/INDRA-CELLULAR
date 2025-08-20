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
        $table->string('id', 100)->primary();
        $table->string('user_id', 100)->nullable(); // id user bisa null
        $table->text('payload');
        $table->integer('last_activity');
        $table->text('user_agent')->nullable();

        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
    });

    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }

};
