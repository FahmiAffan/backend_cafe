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
        //
        Schema::create('pengguna',  function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama_pengguna');
            $table->string('email');
            $table->string('password');
            $table->enum('level', ['admin', 'mitra' , 'customer']);
            $table->integer('saldo');
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
        //
        Schema::dropIfExists('pengguna');
    }
};
