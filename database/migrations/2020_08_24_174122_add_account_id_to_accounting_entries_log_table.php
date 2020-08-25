<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountIdToAccountingEntriesLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_entries_log', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('debtor')->nullable();
            $table->string('creditor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_entries_log', function (Blueprint $table) {
            //
        });
    }
}
