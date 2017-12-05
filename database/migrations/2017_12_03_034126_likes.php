<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Likes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->primary(['pid', 'userID']);
            $table->string('pid')->after('cid')->unsigned();
            $table->foreign('pid')
                ->references('pid')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('userID')->after('pid')->unsigned();
            $table->foreign('userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('likes');
    }
}
