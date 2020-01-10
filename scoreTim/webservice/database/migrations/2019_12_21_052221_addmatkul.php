<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addmatkul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('user_id')->unsigned();
        });

        Schema::table('mata_kuliah', function($table) {
            $table->foreign('user_id')->references('id')->on('user2')->onDelete('cascade');
        });

        Schema::table('nilai_dosens', function($table) {
            $table->integer('matkul_id')->unsigned(); 
        });

        Schema::table('nilai_dosens', function($table) {
            $table->foreign('matkul_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
