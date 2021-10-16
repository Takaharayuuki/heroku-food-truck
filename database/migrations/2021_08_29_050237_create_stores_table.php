<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(0)->comment('カテゴリID');
            $table->string('name')->comment('出店店舗名');
            $table->string('address')->comment('出店場所');
            $table->string('business_hours')->comment('営業時間');
            $table->text('remark')->comment('備考');
            $table->string('period')->comment('出店期間');
            $table->string('thumbnail_url')->comment('出店画像URL');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
