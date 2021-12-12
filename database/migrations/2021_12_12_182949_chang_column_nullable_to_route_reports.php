<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangColumnNullableToRouteReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_reports', function (Blueprint $table) {
            $table->decimal('cash')->nullable()->change();
            $table->decimal('expenses')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('visa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_reports', function (Blueprint $table) {
            //
        });
    }
}
