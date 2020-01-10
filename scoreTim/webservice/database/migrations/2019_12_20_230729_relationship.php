<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nilai_dosens');

        Schema::create('nilai_dosens', function (Blueprint $table) {
            $table->increments('id');
            $table->float('KetepatanWaktu');
            $table->float('Kelengkapan');
            $table->float('KualitasHasil');
            $table->integer('tim_id')->unsigned();
        });

        Schema::table('nilai_dosens', function($table) {
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
        //
    }
}
