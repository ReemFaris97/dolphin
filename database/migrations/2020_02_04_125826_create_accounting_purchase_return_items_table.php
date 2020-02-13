<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingPurchaseReturnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_purchase_return_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('purchase_return_id')->nullable();
            $table->foreign('purchase_return_id')->references('id')
                ->on('accounting_purchases_returns')->onDelete('cascade')
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
        Schema::dropIfExists('accounting_purchase_return_items');
    }
}
