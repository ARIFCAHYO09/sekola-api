<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('NPSN');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->unsignedBigInteger('kelurahan_id');
            // $table->foreign('kelurahan_id')->references('id')->on('kelurahan');
            $table->string('jenjang_pendidikan');
            $table->integer('status_sekolah');
            $table->integer('status_aktif');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('website');
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
        Schema::dropIfExists('sekolah');
    }
}