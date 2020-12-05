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
            $table->integer('job_level');
            $table->integer('job_type');
            $table->integer('job_salary_type');
            $table->bigInteger('job_minimum_salary')->nullable();
            $table->bigInteger('job_maximum_salary')->nullable();
            $table->longText('job_description');
            $table->longText('job_requirement');
                $table->string('cv_language');
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->timestamps();
        });
    }
    /* job level:
        0: mới tốt nghiệp
        1: Nhân viên
        2: Trưởng phòng
        3: Giảm đốc và cấp cao hơn
    /* job type:
        0: toàn thời gian
        1: bán thời gian
        2: thực tập
        3: nghề tự do
        4: hợp đồng thời vụ
        5: khác
    */
    /* job salary type:
        0: nhập
        1: thương lượng
    */
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
