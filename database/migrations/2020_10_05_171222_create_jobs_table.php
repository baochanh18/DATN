<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('job_title');
            $table->string('company_name');
            $table->string('address');
            $table->string('company_website_url')->nullable();
            $table->string('company_youtube_url')->nullable();
            $table->string('company_logo')->default("avatars/default/company-profile.png");
            $table->boolean('is_expire')->default(false);
            $table->date('active_day')->nullable();
            $table->integer('job_status')->default(0);
            $table->longText('company_descriptions');
            $table->integer('company_size');
            $table->timestamps();
        });
    }
    /* job status
        0: nháp
        1: đang kiểm tra
        2: được kích hoạt
        3: bị ẩn
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
