<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('rid');
            $table->string('er_userID')->unsigned();
            $table->foreign('er_userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('ee_userID')->unsigned();
            $table->foreign('ee_userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('pid')->unsigned()->nullable();
            $table->foreign('pid')
                ->references('pid')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('reasons')->nullable();
            $table->dateTime('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
