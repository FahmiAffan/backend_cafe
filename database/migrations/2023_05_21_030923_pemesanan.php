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
        Schema::create('pemesanan',  function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('id_meja');
            $table->unsignedBigInteger('id_users');
            $table->integer('jumlah_pemesanan');
            $table->timestamps();
        });
        Schema::table('pemesanan', function (Blueprint $table){
            $table->foreign('id_menu')->references('id_menu')->on('menu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_meja')->references('id_meja')->on('meja')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pembayaran');
    }
};
