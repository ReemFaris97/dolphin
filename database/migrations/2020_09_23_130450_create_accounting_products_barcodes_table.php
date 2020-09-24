<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingProductsBarcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_products_barcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('product_id');
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade')
                ->onUpdate('cascade');

                $table->string('barcode')->nullable();

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
        Schema::dropIfExists('accounting_products_barcodes');
    }
}
