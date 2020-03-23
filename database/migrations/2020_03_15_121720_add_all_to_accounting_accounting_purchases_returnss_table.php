<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllToAccountingAccountingPurchasesReturnssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_purchases_returns', function (Blueprint $table) {
            $table->string('amount')->nullable();
            $table->string('discount')->nullable();

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')
                ->on('accounting_suppliers')->onDelete('cascade')
                ->onUpdate('cascade');

                $table->unsignedBigInteger('store_id')->nullable();
                $table->foreign('store_id')->references('id')
                    ->on('accounting_stores')->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->enum('payment',['cash','agel'])->nullable();
                 $table->string('payed')->nullable();
                    $table->string('totalTaxs')->nullable();
                    $table->string('bill_num')->nullable();
                    $table->enum('discount_type',['percentage','amount'])->nullable();
                    $table->string('bill_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_accounting_purchases_returnss', function (Blueprint $table) {
            //
        });
    }
}
