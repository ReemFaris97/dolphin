<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConcernedToAccountingMoneyClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_money_clauses', function (Blueprint $table) {
            $table->enum('concerned',['client','supplier'])->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')
                ->on('accounting_clients')->onDelete('cascade')
                ->onUpdate('cascade');

                $table->unsignedBigInteger('supplier_id')->nullable();
                $table->foreign('supplier_id')->references('id')
                    ->on('accounting_suppliers')->onDelete('cascade')
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
