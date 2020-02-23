<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BsSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_soal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mapel_id')->unsigned();
            $table->foreign('mapel_id')->references('id')->on('bank_soal_mapel');
            $table->bigInteger('kelas_id')->unsigned();
            $table->foreign('kelas_id')->references('id')->on('kelas_edukasi');
            $table->string('nama');
            $table->double('jumlah_soal');
            $table->double('skoring');
            $table->enum('level', ['lock', 'unlock'])->default('lock');
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
        Schema::dropIfExists('bank_soal');
    }
}