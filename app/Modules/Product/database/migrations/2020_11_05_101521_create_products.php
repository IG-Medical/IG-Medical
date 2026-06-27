<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('main_image')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('name');
            $table->text('youtube')->nullable();
            $table->text('pdf')->nullable();
            $table->text('short_description');
            $table->longText('description');
            $table->longText('basic_configuration')->nullable();
            $table->decimal('price', 18, 2)->unsigned()->nullable();
            $table->float('discount_percentage')->unsigned()->nullable();
            $table->integer('qty')->nullable();
            $table->boolean('is_new')->nullable();
            $table->boolean('is_active')->default(YES);
            $table->integer('number_of_sales')->nullable()->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete(ON_DELETE);
            $table->foreign('product_id')->references('id')->on('products')->onDelete(ON_DELETE);
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
