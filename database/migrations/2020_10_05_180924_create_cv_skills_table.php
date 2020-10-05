<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained('cvs');
            $table->foreignId('skill_category_id')->nullable()->constrained('skill_categories');
            $table->string('skill_name')->nullable();
            $table->integer('skill_level');
            $table->integer('year_of_use');
            $table->string('skill_descriptions');
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
        Schema::dropIfExists('cv_skills');
    }
}
