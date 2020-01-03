<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequstIdToAccountingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_transactions', function (Blueprint $table) {

            $table->unsignedBigInteger('request_id')->nullable();
            $table->foreign('request_id')->references('id')
                ->on('accounting_stores_requests')->onDelete('cascade')
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
        Schema::table('accounting_transactions', function (Blueprint $table) {
            //
        });
    }
}
