<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_reports', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedbigInteger('route_id');

            $table->foreign('route_id')->references('id')
                ->on('distributor_routes')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->decimal('cash');
            $table->decimal('expenses');
            $table->string('image');

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
        Schema::dropIfExists('route_reports');
    }
}
