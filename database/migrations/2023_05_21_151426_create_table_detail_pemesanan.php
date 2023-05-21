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
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->id('id_detail_pemesanan');
            $table->unsignedBigInteger('id_pemesanan');
            $table->integer('jumlah_pemesanan');
            $table->integer('total_harga');
            $table->timestamps();
        });
        Schema::table('detail_pemesanan', function (Blueprint $table){
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemesanan');
    }
};
