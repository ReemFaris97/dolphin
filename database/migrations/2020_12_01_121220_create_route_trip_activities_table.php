<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTripActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/* 'route_id', 'client_id', 'lat', 'lng', 'address', 'status' , 'arrange','cash' */
        Schema::create('route_trip_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('route_trip_id');
            $table->enum();
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
        Schema::dropIfExists('route_trip_activities');
    }
}
