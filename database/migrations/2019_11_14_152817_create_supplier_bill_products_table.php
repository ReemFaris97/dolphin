<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierBillProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_bill_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_bill_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->float('price');
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
        Schema::dropIfExists('supplier_bill_products');
    }
}
