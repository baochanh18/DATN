<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs');
            $table->integer('job_salary_type');
            $table->bigInteger('job_minimum_salary')->nullable();
            $table->bigInteger('job_maximum_salary')->nullable();
            $table->integer('job_money_type')->nullable();
            $table->integer('job_minimum_age');
            $table->integer('job_maximum_age');
            $table->boolean('gender');
            $table->string('job_description');
            $table->integer('job_literacy');
            $table->integer('year_of_work');
            $table->string('job_requirement');
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
        Schema::dropIfExists('job_details');
    }
}
