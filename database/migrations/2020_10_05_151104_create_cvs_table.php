<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');
            $table->string('name');
            $table->boolean('gender');
            $table->dateTime('birthday');
            $table->boolean('marital_status');
            $table->string('nationality');
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->integer('cv_status');
            $table->timestamps();
        });
    }
    /*
     * marital_status boolean
    nationality varchar
    avatar varchar
    phone varchar
     email varchar
    cv_status varchar
    address_id int
    */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cvs');
    }
}
