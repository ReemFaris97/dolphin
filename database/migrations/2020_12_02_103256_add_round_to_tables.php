<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoundToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributor_routes', function (Blueprint $table) {
            $table->unsignedBigInteger('round')->default(0)->index();
        });
        Schema::table('route_trips', function (Blueprint $table) {
            $table->unsignedBigInteger('round')->default(0)->index();
        });
        Schema::table('trip_inventories', function (Blueprint $table) {
            $table->unsignedBigInteger('round')->default(0)->index();
        });
        Schema::table('route_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('round')->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributor_routes', function (Blueprint $table) {
            $table->dropIndex(['round']);
            $table->dropColumn(['round']);
        });
        Schema::table('route_trips', function (Blueprint $table) {
            $table->dropIndex(['round']);
            $table->dropColumn(['round']);
        });
        Schema::table('trip_inventories', function (Blueprint $table) {
            $table->dropIndex(['round']);
            $table->dropColumn(['round']);
        });
        Schema::table('route_reports', function (Blueprint $table) {
            $table->dropIndex(['round']);
            $table->dropColumn(['round']);
        });
    }
}
