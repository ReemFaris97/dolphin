<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingAccountsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_accounts_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('entry_id')->nullable();
            $table->foreign('entry_id')->references('id')
                ->on('accounting_entries')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('account_amount_before')->nullable();

            $table->unsignedBigInteger('another_account_id')->nullable();
            $table->foreign('another_account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('affect',['creditor','debtor'])->nullable();
            $table->string('amount')->nullable();

            $table->string('account_amount_after')->nullable();

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
        Schema::dropIfExists('accounting_accounts_logs');
    }
}
