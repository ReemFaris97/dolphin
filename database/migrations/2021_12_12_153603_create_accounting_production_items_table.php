<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingProductionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_production_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('production_id')->nullable();
            $table->foreign('production_id')->references('id')
<<<<<<< HEAD
                ->on('accounting_productions')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')
                ->on('accounting_products')->onDelete('cascade')
                ->onUpdate('cascade');
=======
                 ->on('accounting_productions')->onDelete('cascade')
                 ->onUpdate('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')
                 ->on('accounting_products')->onDelete('cascade')
                 ->onUpdate('cascade');
>>>>>>> 06c87c9d7921fde4a7e1777d79c9ba5892bb35e8

            $table->unsignedBigInteger('unit_id')->index()->nullable();
            // $table->foreign('unit_id')->references('id')
            //     ->on('accounting_products_subunits')->onDelete('cascade')
            //     ->onUpdate('cascade');

            $table->string('quantity')->nullable();

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
        Schema::dropIfExists('accounting_production_items');
    }
}
