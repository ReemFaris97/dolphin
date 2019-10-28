<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsSubunitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_products_subUnits', function (Blueprint $table) {
            $table->bigIncrements('id');



            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')
                ->on('accounting_products')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name')->nullable();
            $table->string('bar_code')->nullable();
            $table->string('main_unit_present')->nullable();

            $table->decimal('selling_price')->nullable();
            $table->decimal('purchasing_price')->nullable();


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
        Schema::dropIfExists('products_subunits');
    }
}
