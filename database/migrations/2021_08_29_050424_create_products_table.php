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
            $table->id();
            $table->unsignedBigInteger('category_id')->default(0)->comment('カテゴリID');
            $table->unsignedBigInteger('store_id')->default(0)->comment('店舗ID');
            $table->string('name')->comment('商品名');
            $table->integer('price')->comment('値段');
            $table->string('thumbnail_url')->comment('商品画像URL');
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->unique(['store_id']);
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
