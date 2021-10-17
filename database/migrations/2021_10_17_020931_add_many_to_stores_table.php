<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManyToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('prefecture');
            $table->string('city');
            $table->string('town');
            $table->string('opening_hours');
            $table->string('closing_time');
            $table->string('category');
            $table->dropColumn('address');
            $table->dropColumn('business_hours');
            $table->dropColumn('period');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
        });
    }
}
