<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->text('caption_1')->nullable();
            $table->text('caption_2')->nullable();
            $table->text('caption_3')->nullable();
            $table->text('call_to_action_text_1')->nullable();
            $table->text('call_to_action_url_1')->nullable();
            $table->text('call_to_action_text_2')->nullable();
            $table->text('call_to_action_url_2')->nullable();
            $table->text('background')->nullable();
            $table->boolean('home_page_top')->default(false);
            $table->boolean('home_page_center')->default(false);
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
        Schema::dropIfExists('sliders');
    }
}
