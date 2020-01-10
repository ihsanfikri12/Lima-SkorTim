<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_dosens', function (Blueprint $table) {
            $table->increments('id');
            $table->float('KetepatanWaktu');
            $table->float('Kelengkapan');
            $table->float('KualitasHasil');
            $table->integer('idTim')->references('id')->on('tims');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_dosens');
    }
}
