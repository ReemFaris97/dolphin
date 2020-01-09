<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_devices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')
                ->on('accounting_product_stores')->onDelete('cascade')
                ->onUpdate('cascade');
                $table->string('name')->nullable();
                $table->string('code')->nullable();

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
        Schema::dropIfExists('accounting_devices');
    }
}
