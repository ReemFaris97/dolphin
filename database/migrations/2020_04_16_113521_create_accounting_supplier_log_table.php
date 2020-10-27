<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSupplierLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_supplier_log', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')
                ->on('accounting_suppliers')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->foreign('purchase_id')->references('id')
                ->on('accounting_purchases')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('clause_id')->nullable();
            $table->foreign('clause_id')->references('id')
                ->on('accounting_money_clauses')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->enum('status',['creditor','debit'])->nullable();
//            $table->enum('operation',['creditor','debit'])->nullable();


            $table->string('amount')->nullable();

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
        Schema::dropIfExists('accounting_supplier_log');
    }
}
