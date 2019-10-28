<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingMoneyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_money_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->decimal('amount');

            $table->morphs('model');

            $table->unsignedBigInteger('clause_id');

            $table->foreign('clause_id')->references('id')
                ->on('accounting_money_clauses')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->text('notes')->nullable();

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
        Schema::dropIfExists('accounting_money_transactions');
    }
}
