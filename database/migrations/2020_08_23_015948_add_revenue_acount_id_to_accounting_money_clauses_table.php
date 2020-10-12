<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevenueAcountIdToAccountingMoneyClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_money_clauses', function (Blueprint $table) {
            $table->unsignedBigInteger('revenue_account_id')->nullable();
            $table->foreign('revenue_account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
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
        Schema::table('accounting_money_clauses', function (Blueprint $table) {
            //
        });
    }
}
