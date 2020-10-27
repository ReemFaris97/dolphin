<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemIdToAccountingItemsDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_items_discounts', function (Blueprint $table) {


     $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')
                ->on('accounting_purchases_items')->onDelete('cascade')
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
        Schema::table('accounting_items_discounts', function (Blueprint $table) {
            //
        });
    }
}
