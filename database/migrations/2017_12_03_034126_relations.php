<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->primary(['follower_userID', 'followed_userID']);
            $table->string('follower_userID')->unsigned();
            $table->foreign('follower_userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('followed_userID')->unsigned();
            $table->foreign('followed_userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('if_notify')->default(true);
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
        Schema::dropIfExists('relations');
    }
}
