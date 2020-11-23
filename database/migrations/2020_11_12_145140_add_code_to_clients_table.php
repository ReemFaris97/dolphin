<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) { 

          $table->string('code')->nullable();

          $table->unsignedBigInteger('route_id')->nullable();
          $table->foreign('route_id')->references('id')
          ->on('distributor_routes')->onDelete('cascade')
          ->onUpdate('cascade');

          $table->unsignedBigInteger('user_id')->nullable();
          $table->foreign('user_id')->references('id')
          ->on('users')->onDelete('cascade')
          ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
}
