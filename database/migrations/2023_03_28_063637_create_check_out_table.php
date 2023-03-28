<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_out', function (Blueprint $table) {
            $table->increments('id_check_out');
            $table->date('tgl_check_out');
            $table->time('jam_check_out');
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
        Schema::dropIfExists('check_out');
    }
}
