<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatcontents',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('ccid');
            $table->string('chatID')->unsigned();
            $table->foreign('chatID')
                ->references('chatID')->on('chats')
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
        Schema::dropIfExists('chatcontents');
    }
}
