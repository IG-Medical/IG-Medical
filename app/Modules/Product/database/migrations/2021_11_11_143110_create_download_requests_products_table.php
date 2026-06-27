<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadRequestsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_requests_products', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('department');
            $table->string('company');
            $table->string('first_name');
            $table->string('surname');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->enum('status',[1,0]);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_requests_products');
    }
}
