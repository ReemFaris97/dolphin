<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_debt_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('debt_id');
            $table->foreign('debt_id')->on('accounting_debts')->references('id')->onDelete('cascade');
            $table->timestamp('date');
            $table->decimal('value')->default(0);
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
        Schema::dropIfExists('debt_payments');
    }
}
