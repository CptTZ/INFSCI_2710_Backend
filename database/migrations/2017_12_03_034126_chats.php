<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->primary(['userID1', 'userID2']);
            $table->string('userID1')->unsigned();
            $table->foreign('userID1')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('userID2')->unsigned();
            $table->foreign('userID2')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->longText('contents');
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
        Schema::dropIfExists('chats');
    }
}
