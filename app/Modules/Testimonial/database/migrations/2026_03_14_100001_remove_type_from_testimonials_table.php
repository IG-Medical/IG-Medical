<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTypeFromTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     * Removes type (web/mobile) column from testimonials.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('testimonials', 'type')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('type')->default('web')->after('id');
        });
    }
}
