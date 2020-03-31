<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankToAccountingMoneyClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_money_clauses', function (Blueprint $table) {


            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')
                ->on('accounting_banks')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('num_transaction')->nullable();
            $table->string('image')->nullable();

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
