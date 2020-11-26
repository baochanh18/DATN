<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('job_id')->constrained('jobs');
            $table->string('full_name');
            $table->string('title')->nullable();
            $table->string('email');
            $table->string('phone_number');
            $table->string('cv_file');
            $table->integer('cv_status')->default(0);
            $table->timestamps();
        });
    }
    /*
        cv_status:
            0: Chưa xem
            1: Đã xem
            2: Đã đủ điều kiện
            3: Mời phỏng vấn
            4: Phỏng vấn thành công
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply_cvs');
    }
}
