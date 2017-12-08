<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->primary('userID');
            $table->string('userID', 20);
            $table->string('password', 15)->after('userID');
            $table->string('nickname', 20)->nullable();
            $table->string('firstname', 20)->nullable();
            $table->string('lastname', 20)->nullable();
            $table->enum('gender',['0','1','2'])->default('2');
            $table->date('DOB')->nullable();
            $table->string('whatsup', 50)->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
