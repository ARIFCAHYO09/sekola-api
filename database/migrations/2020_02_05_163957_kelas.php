<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_soal_kelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mapel_id')->unsigned();
            $table->foreign('mapel_id')->references('id')->on('bank_soal_mapel');
            $table->bigInteger('kelas_id')->unsigned();
            $table->foreign('kelas_id')->references('id')->on('kelas_edukasi');
            $table->bigInteger('edukasi_id')->unsigned();
            $table->foreign('edukasi_id')->references('id')->on('edukasi');
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
        Schema::dropIfExists('bank_soal_kelas');
    }
}