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
        Schema::create('pembayaran', function(Blueprint $table){
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_pemesanan');
            $table->enum('status_pembayaran',['sukses','gagal']);
            $table->integer('total_harga_pemesanan');
            $table->integer('biaya_admin');
            $table->integer('kembalian');
            $table->timestamps();
        });
        Schema::table('pembayaran',function(Blueprint $table){
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan')->onDelete('cascade')->onUpdate('cascade');
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
    }
};
