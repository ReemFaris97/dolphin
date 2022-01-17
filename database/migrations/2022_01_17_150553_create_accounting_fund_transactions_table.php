<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingFundTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_fund_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fund_id');
            $table->enum('type', ['in','out']);
            $table->string('amount');
            $table->string('description');
            $table->morphs('billable');
            $table->boolean('should_reverse')->default(0);
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
        Schema::dropIfExists('accounting_fund_transactions');
    }
}
