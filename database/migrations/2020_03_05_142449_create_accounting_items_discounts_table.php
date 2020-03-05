<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingItemsDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_items_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('discount_type',['percentage','amount'])->nullable();
            $table->boolean('discount')->nullable();
            $table->boolean('affect_tax')->nullable();


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
        Schema::dropIfExists('accounting_items_discounts');
    }
}
