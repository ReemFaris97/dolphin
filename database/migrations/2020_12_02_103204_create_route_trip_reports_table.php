<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTripReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_trip_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_trip_id')->index();
            $table->unsignedBigInteger('store_id')->index();
            $table->unsignedBigInteger('round')->default(0)->index();
            $table->decimal('cash', 10, 5)->index()->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('distributor_transaction_id')->index()->nullable();
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
        Schema::dropIfExists('route_trip_reports');
    }
}
