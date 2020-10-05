<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_exps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cvs');
            $table->string('company_name');
            $table->integer('year_of_work');
            $table->string('position');
            $table->foreignId('job_category_id')->constrained('job_categories');
            $table->integer('start_month');
            $table->integer('start_year');
            $table->integer('end_month');
            $table->integer('end_year');
            $table->string('work_exp_description');
            $table->timestamps();
        });
    }
    /*
     cv_id int
      company_name varchar
      yearofwork int
      position varchar
      start_month int
      start_year int
      end_month int
      end_year int
      description varchar
     * /
     */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_exps');
    }
}
