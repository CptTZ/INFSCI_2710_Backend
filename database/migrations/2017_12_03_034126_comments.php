<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('cid');
            $table->string('pid')->after('cid')->unsigned();
            $table->foreign('pid')
                ->references('pid')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('userID')->after('pid')->unsigned();
            $table->foreign('userID')
                ->references('userID')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('contents', 100);
            $table->dateTime('timestamp');
        });

        /*Schema::table('comments', function (Blueprint $table) {

        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
