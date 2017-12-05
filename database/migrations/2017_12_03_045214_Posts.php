<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('pid');
            $table->string('userID')->after('pid')->unsigned();
            $table->foreign('userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->longText('contents')->nullable();
            $table->dateTime('timestamp');
            $table->string('pic_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
