<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingEntriesAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_entries_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('entry_id')->nullable();
            $table->foreign('entry_id')->references('id')
                ->on('accounting_entries')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('from_account_id')->nullable();
            $table->foreign('from_account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('to_account_id')->nullable();
            $table->foreign('to_account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('amount')->nullable();
//            $table->string('creditor')->nullable();



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
        Schema::dropIfExists('accounting_entries_accounts');
    }
}
