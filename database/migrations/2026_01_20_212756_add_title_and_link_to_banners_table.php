<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndLinkToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            if (!Schema::hasColumn('banners', 'title')) {
                $table->string('title')->nullable()->after('id');
            }
            if (!Schema::hasColumn('banners', 'link')) {
                $table->string('link')->nullable()->after('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            if (Schema::hasColumn('banners', 'title')) {
                $table->dropColumn('title');
            }
            if (Schema::hasColumn('banners', 'link')) {
                $table->dropColumn('link');
            }
        });
    }
}
