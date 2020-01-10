<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nilai_tims');

        Schema::create('nilai_tims', function (Blueprint $table) {
            $table->increments('id');
            $table->float('nilaiTim');
            $table->integer('tim_id')->unsigned();
        });

        Schema::table('nilai_tims', function($table) {
            $table->foreign('tim_id')->references('id')->on('tims')->onDelete('cascade');;
        });

        Schema::create('nilai_ujians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matkul');
            $table->float('nilaiUts');
            $table->float('nilaiUas');
            $table->integer('tim_id')->unsigned();
        });

        Schema::table('nilai_ujians', function($table) {
            $table->foreign('tim_id')->references('id')->on('tims')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_ujians');
    }
}
