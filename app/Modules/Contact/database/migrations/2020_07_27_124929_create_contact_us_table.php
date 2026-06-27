<?php

use Contact\Models\ContactUs;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('subject')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('favorite_product')->nullable();
            $table->string('country')->nullable();
            $table->text('message')->nullable();
            $table->integer('status_id')->default(ContactUs::STATUS_OPEN);
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
        Schema::dropIfExists('contact_us');
    }
}
