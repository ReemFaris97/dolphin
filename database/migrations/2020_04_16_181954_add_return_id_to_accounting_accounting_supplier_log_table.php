<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReturnIdToAccountingAccountingSupplierLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_supplier_log', function (Blueprint $table) {
            $table->unsignedBigInteger('return_id')->nullable();
            $table->foreign('return_id')->references('id')
                ->on('accounting_purchases_returns')->onDelete('cascade')
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
        Schema::table('accounting_accounting_supplier_log', function (Blueprint $table) {
            //
        });
    }
}
