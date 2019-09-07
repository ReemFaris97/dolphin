<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedbigInteger('trip_id');

            $table->foreign('trip_id')->references('id')
                ->on('route_trips')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->enum('type',['accept','refuse']);
            $table->text('notes')->nullable();
            $table->text('refuse_reason')->nullable();

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
        Schema::dropIfExists('trip_inventories');
    }
}
