<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDesiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_desires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cvs');
            $table->string('job_title');
            $table->integer('desire_salary_type');
            $table->bigInteger('desire_minimum_salary')->nullable();
            $table->bigInteger('desire_maximum_salary')->nullable();
            $table->integer('desire_money_type')->nullable();
            $table->integer('desire_job_position');
            $table->integer('desire_job_type');
            $table->string('desire_job_description');
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
        Schema::dropIfExists('job_desires');
    }
}
