<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Job\Models\CareerApplication;

class CreateCareerApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('career_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->enum('salutation', [
                CareerApplication::SALUTATIONS_MR,
                CareerApplication::SALUTATIONS_MRS,
                CareerApplication::SALUTATIONS_MS
            ]);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('street');
            $table->string('number');
            $table->string('plz');
            $table->string('place_of_residence');
            $table->string('land');
            $table->string('salary_expectations');
            $table->string('earliest_start_of_work');
            $table->string('miscellaneous')->nullable();
            $table->integer('attentive_to_business_through')->nullable();
            $table->integer('internal_application')->nullable();
            $table->integer('data_protection')->nullable();
            $table->integer('admission_to_talent_pool')->nullable();
            $table->string('file_write_to')->nullable();
            $table->string('file_total_package')->nullable();
            $table->string('file_miscellaneous')->nullable();
            $table->string('file_testimonials')->nullable();
            $table->string('file_curriculum')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('career_id')->on('careers')->references('id')->onDelete(ON_DELETE);
            $table->foreign('status_id')->on('career_application_statuses')->references('id')->onDelete(ON_DELETE);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_applications');
    }
}
