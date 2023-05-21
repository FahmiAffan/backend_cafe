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
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_pengguna');
            $table->integer('jumlah_pemesanan');
            $table->integer('total_harga');
            $table->timestamps();
        });
        Schema::table('pemesanan', function (Blueprint $table){
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->onDelete('cascade')->onUpdate('cascade');
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
