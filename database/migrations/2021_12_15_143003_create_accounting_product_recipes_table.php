<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingProductRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('accounting_product_recipes', function (Blueprint $table) {
        //     $table->id();

        //     $table->unsignedBigInteger('product_id')->nullable();
        //     $table->foreign('product_id')->references('id')
        //         ->on('accounting_products')->onDelete('cascade')
        //         ->onUpdate('cascade');

        //     $table->unsignedBigInteger('unit_id')->index()->nullable();
        //     $table->foreign('unit_id')->references('id')
        //         ->on('accounting_products_subUnits')->onDelete('cascade')
        //         ->onUpdate('cascade');

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_product_recipes');
    }
}
