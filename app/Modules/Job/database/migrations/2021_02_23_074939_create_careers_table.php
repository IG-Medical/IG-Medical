<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareersTable extends Migration
{

    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('job_title');
            $table->text('description')->nullable();
            $table->text('location')->nullable();
            $table->text('experience')->nullable();
            $table->text('status')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('deadline')->nullable();
            $table->text('gender')->nullable();
            $table->integer('count_applicants')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('career_categories')->onDelete(ON_DELETE);

        });
    }

    public function down()
    {
        Schema::dropIfExists('careers');
    }
}
