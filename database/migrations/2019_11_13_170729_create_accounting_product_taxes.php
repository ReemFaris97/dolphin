<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingProductTaxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_product_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')
                ->on('accounting_products')->onDelete('cascade')
                ->onUpdate('cascade');


            $table->boolean('tax')->nullable();
            $table->boolean('price_has_tax')->nullable();
            $table->string('tax_value')->nullable();

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
        Schema::dropIfExists('accounting_product_taxes');
    }
}
