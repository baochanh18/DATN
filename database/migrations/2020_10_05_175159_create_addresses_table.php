<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_desire_id')->nullable()->constrained('job_desires');
            $table->foreignId('work_exp_id')->nullable()->constrained('work_exps');
            $table->foreignId('company_profile_id')->nullable()->constrained('company_profiles');
            $table->foreignId('job_contact_id')->nullable()->constrained('job_contacts');
            $table->foreignId('job_detail_id')->nullable()->constrained('job_details');
            $table->foreignId('country_id')->constrained('countries');
            $table->string('address');
            $table->foreignId('location_id')->nullable()->constrained('locations');
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
        Schema::dropIfExists('addresses');
    }
}