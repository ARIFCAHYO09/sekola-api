<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->string('nuptk');
            $table->integer('role');
            $table->string('foto');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('point');
            $table->rememberToken();
            $table->unsignedBigInteger('sekolah_id');
            $table->foreign('sekolah_id')->references('id')->on('sekolah');
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
        Schema::dropIfExists('users');
    }
}