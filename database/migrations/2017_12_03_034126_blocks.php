<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Blocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->primary(['userID', 'pid']);
            $table->string('userID')->unsigned();
            $table->foreign('userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('pid')->unsigned();
            $table->foreign('pid')
                ->references('pid')->on('posts')
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
        Schema::dropIfExists('blocks');
    }
}
