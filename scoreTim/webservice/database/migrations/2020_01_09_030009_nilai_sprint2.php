<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NilaiSprint2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_dosens', function (Blueprint $table) {
            $table->integer('nilaiSprint_id')->nullable()->unsigned();
            $table->foreign('nilaiSprint_id')->references('id')->on('nilai_sprints')->onDelete('cascade');
        });

        Schema::table('nilai_points', function (Blueprint $table) {
            $table->integer('nilaiSprint_id')->nullable()->unsigned();
            $table->foreign('nilaiSprint_id')->references('id')->on('nilai_sprints')->onDelete('cascade');
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
