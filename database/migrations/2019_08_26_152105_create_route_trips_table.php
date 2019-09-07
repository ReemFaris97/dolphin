<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_trips', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedbigInteger('route_id');

            $table->foreign('route_id')->references('id')
                ->on('distributor_routes')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedbigInteger('client_id');

            $table->foreign('client_id')->references('id')
                ->on('clients')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('lat');
            $table->string('lng');
            $table->string('address');

            $table->integer('arrange');
            $table->enum('status',['pending','accepted','refused'])->default('pending');

            $table->softDeletes();
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
        Schema::dropIfExists('route_trips');
    }
}
