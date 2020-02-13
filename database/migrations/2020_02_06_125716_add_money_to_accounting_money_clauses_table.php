<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoneyToAccountingMoneyClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_money_clauses', function (Blueprint $table) {
            $table->unsignedBigInteger('safe_id')->nullable();
            $table->foreign('safe_id')->references('id')
                ->on('accounting_safes')->onDelete('cascade')
                ->onUpdate('cascade');
                
                $table->string('amount')->nullable();


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
