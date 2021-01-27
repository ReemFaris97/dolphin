<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRouteTripIdAndRoundToProductQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_quantities', function (Blueprint $table) {
            $table->unsignedBigInteger('route_trip_id')->index()->nullable();
            $table->unsignedBigInteger('round')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_quantities', function (Blueprint $table) {
            $table->dropIndex(['route_trip_id']);
            $table->dropIndex(['round']);
            $table->dropColumn(['route_trip_id', 'round']);

        });
    }
}
