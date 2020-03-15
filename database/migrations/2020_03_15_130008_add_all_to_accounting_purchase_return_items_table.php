<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllToAccountingPurchaseReturnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_purchase_return_items', function (Blueprint $table) {
            $table->enum('unit_type',['main','sub'])->nullable();
            $table->string('price')->nullable();
            $table->string('tax')->nullable();
            $table->string('price_after_tax')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')
                ->on('accounting_products_subUnits')->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_purchase_return_items', function (Blueprint $table) {
            //
        });
    }
}
