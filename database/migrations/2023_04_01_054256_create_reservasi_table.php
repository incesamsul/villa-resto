<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->increments('id_reservasi');
            $table->date('tgl_check_in');
            $table->integer('jumlah_tamu');
            $table->integer('booking_fee');
            $table->unsignedInteger('id_kamar');
            $table->unsignedInteger('id_tamu');
            $table->timestamps();
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tamu')->references('id_tamu')->on('tamu')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
}
