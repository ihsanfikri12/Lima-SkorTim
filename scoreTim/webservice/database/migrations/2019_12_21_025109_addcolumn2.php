<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumn2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('nilai_dosens', function (Blueprint $table) {
            $table->integer('user_id')->after('tim_id')->unsigned();
        });

        Schema::table('nilai_points', function (Blueprint $table) {
            $table->integer('user_id')->after('tim_id')->unsigned();
        });

        Schema::table('nilai_dosens', function($table) {
            $table->foreign('user_id')->references('id')->on('user2')->onDelete('cascade');
        });

        Schema::table('nilai_points', function($table) {
            $table->foreign('user_id')->references('id')->on('user2')->onDelete('cascade');
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
