<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiTimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_tims', function (Blueprint $table) {
            $table->increments('id');
            $table->float('nilaiUts');
            $table->float('nilaiUas');
            $table->float('nilaiTim');
            $table->integer('tim_id')->unsigned();
        });

        Schema::table('nilai_tims', function($table) {
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
        Schema::dropIfExists('nilai_tims');
    }
}
