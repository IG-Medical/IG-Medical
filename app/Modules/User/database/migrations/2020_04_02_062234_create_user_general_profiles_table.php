<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGeneralProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('date_birth')->nullable();
            $table->enum('gender', [MALE, FEMALE])->nullable();
            $table->text('about_me')->nullable();
            $table->text('telephone')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->on('users')->references('id')->onDelete(ON_DELETE);
            $table->foreign('country_id')->on('countries')->references('id')->onDelete(ON_DELETE);
            $table->foreign('region_id')->on('regions')->references('id')->onDelete(ON_DELETE);
            $table->foreign('city_id')->on('cities')->references('id')->onDelete(ON_DELETE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_general_profiles');
    }
}
