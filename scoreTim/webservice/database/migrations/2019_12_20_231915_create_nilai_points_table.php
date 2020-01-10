<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->float('keterangan');
            $table->float('point');
            $table->integer('tim_id')->unsigned();
        });

        Schema::table('nilai_points', function($table) {
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
        Schema::dropIfExists('nilai_points');
    }
}
