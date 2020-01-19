<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_safes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->string('custody')->nullable();
            $table->string('name')->nullable();
            $table->boolean('type')->default(0)->nullable();
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')
                ->on('accounting_devices')->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('accounting_safes');
    }
}
