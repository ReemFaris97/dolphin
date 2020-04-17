<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewBalanceToAccountingAccountingSupplierLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_supplier_log', function (Blueprint $table) {
            $table->string('new_balance')->nullable();
            $table->string('type')->nullable();

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
