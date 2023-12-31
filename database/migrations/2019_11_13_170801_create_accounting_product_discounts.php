<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingProductDiscounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_product_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')
                ->on('accounting_products')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->enum('discount_type',['percent','quantity'])->nullable();
            $table->string('quantity')->nullable();

            $table->string('gift_quantity')->nullable();
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
        Schema::dropIfExists('accounting_product_discounts');
    }
}
