<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name');
            $table->longText('description');
            $table->integer('company_size');
            $table->string('website_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('logo')->nullable();
            $table->string('contact_office_name');
            $table->string('contact_office_phone');
            $table->string('contact_office_fax')->nullable();
            $table->string('contact_office_email');
            $table->string('contact_person_name');
            $table->string('contact_person_phone')->nullable();
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
        Schema::dropIfExists('company_profiles');
    }
}
