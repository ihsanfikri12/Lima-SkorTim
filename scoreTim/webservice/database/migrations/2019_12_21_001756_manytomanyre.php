<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Manytomanyre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('dosen_sprint');
        Schema::dropIfExists('point_sprint');
        Schema::dropIfExists('ujian_nilaiTim');
        Schema::dropIfExists('sprint_nilaiTim');

        Schema::create('dosen_sprint', function (Blueprint $table) {
            $table->integer('dosen_id')->unsigned();
            $table->integer('sprint_id')->unsigned();
        });

        Schema::create('point_sprint', function (Blueprint $table) {
            $table->integer('point_id')->unsigned();
            $table->integer('sprint_id')->unsigned();
        });

        Schema::create('sprint_nilaiTim', function (Blueprint $table) {
            $table->integer('sprint_id')->unsigned();
            $table->integer('nilaiTim_id')->unsigned();
        });

        Schema::create('ujian_nilaiTim', function (Blueprint $table) {
            $table->integer('ujian_id')->unsigned();
            $table->integer('nilaiTim_id')->unsigned();
        });


        Schema::table('dosen_sprint', function($table) {
            $table->foreign('dosen_id')->references('id')->on('nilai_dosens')->onDelete('cascade');
            $table->foreign('sprint_id')->references('id')->on('nilai_sprints')->onDelete('cascade');
        });

        Schema::table('point_sprint', function($table) {
            $table->foreign('point_id')->references('id')->on('nilai_points')->onDelete('cascade');
            $table->foreign('sprint_id')->references('id')->on('nilai_sprints')->onDelete('cascade');
        });

        Schema::table('sprint_nilaiTim', function($table) {
            $table->foreign('sprint_id')->references('id')->on('nilai_sprints')->onDelete('cascade');
            $table->foreign('nilaiTim_id')->references('id')->on('nilai_tims')->onDelete('cascade');
        });

        Schema::table('ujian_nilaiTim', function($table) {
            $table->foreign('ujian_id')->references('id')->on('nilai_ujians')->onDelete('cascade');
            $table->foreign('nilaiTim_id')->references('id')->on('nilai_tims')->onDelete('cascade');
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
