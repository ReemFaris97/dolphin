<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingDamagesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_damages_products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('damage_id')->nullable();
            $table->foreign('damage_id')->references('id')
                ->on('accounting_damages')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')
                ->on('accounting_products')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('accounting_damages_products');
    }
}
