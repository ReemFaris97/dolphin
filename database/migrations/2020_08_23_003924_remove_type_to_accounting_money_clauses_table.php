<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTypeToAccountingMoneyClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_money_clauses', function (Blueprint $table) {
            DB::statement("ALTER TABLE accounting_money_clauses MODIFY COLUMN type ENUM('revenue','expenses','check_revenue','check_expenses') NOT NULL DEFAULT 'revenue'");

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

        });
    }
}
