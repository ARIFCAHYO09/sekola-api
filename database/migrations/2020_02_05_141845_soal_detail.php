<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoalDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_soal_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('soal_id')->unsigned();
            $table->foreign('soal_id')->references('id')->on('bank_soal');
            $table->integer('no_soal');
            $table->string('nama', 255);
            $table->string('pilihan_A', 255);
            $table->string('pilihan_B', 255);
            $table->string('pilihan_C', 255);
            $table->string('pilihan_D', 255);
            $table->string('jawaban', 20);
            $table->text('penjelasan')->nullable();
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
        Schema::dropIfExists('bank_soal_detail');
    }
}
