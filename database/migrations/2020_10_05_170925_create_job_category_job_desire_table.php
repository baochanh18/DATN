<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCategoryJobDesireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_category_job_desire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_category_id')->constrained('job_categories');
            $table->foreignId('job_desire_id')->constrained('job_desires');
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
        Schema::dropIfExists('job_category_job_desire');
    }
}
