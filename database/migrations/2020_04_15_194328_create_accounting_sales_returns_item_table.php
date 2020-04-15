<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSalesReturnsItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_sales_returns_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sale_return_id')->nullable();
            $table->foreign('sale_return_id')->references('id')
                ->on('accounting_sales_returns')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')
                ->on('accounting_products')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();

            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')
                ->on('accounting_products_subUnits')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->enum('unit_type',['main','sub'])->nullable();





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
        Schema::dropIfExists('accounting_sales_returns_item');
    }
}
