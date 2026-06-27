<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlatformTypeToSlidersTable extends Migration
{
    /**
     * Run the migrations.
     * Adds type column (web/mobile) like Testimonial module.
     *
     * @return void
     */
    public function up()
    {
        // if (Schema::hasColumn('sliders', 'type')) {
        //     return;
        // }
        Schema::table('sliders', function (Blueprint $table) {
            // $table->string('type')->default('web')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            // $table->dropColumn('type');
        });
    }
}
