<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostCenterToAccountingMoneyClausesyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_money_clauses', function (Blueprint $table) {

            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')->references('id')
                ->on('accounting_cost_centers')->onDelete('cascade')
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
        Schema::table('accounting_money_clausesy', function (Blueprint $table) {
            //
        });
    }
}
