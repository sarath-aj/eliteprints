<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('price');
            $table->boolean('featured')->default(false);
            $table->integer('brand_id')->unsigned()->index();
            $table->string('gender');
            $table->string('sleeve');
            $table->string('neck');
            $table->string('color');
            $table->string('fit');
            $table->string('occasion');
            $table->string('main_image');
            $table->text('image_gallery')->nullable();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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