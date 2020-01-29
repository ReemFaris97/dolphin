<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->decimal('amount')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('total')->nullable();

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')
                ->on('accounting_suppliers')->onDelete('cascade')
                ->onUpdate('cascade');

                $table->unsignedBigInteger('store_id')->nullable();
                $table->foreign('store_id')->references('id')
                    ->on('accounting_stores')->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->enum('payment',['cash','agel'])->nullable();

            $table->decimal('payed')->nullable();
            $table->decimal('debts')->nullable();
            $table->string('totalTaxs')->nullable();


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
        Schema::dropIfExists('accounting_purchases');
    }
}
