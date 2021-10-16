<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id()->comment('レビューID');
            $table->unsignedBigInteger('user_id')->default(0)->comment('ユーザーID');
            $table->unsignedBigInteger('store_id')->default(0)->comment('店舗ID');
            $table->text('comment')->comment('コメント');
            $table->integer('rate')->default(0)->comment('レビュー評価');
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['store_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
