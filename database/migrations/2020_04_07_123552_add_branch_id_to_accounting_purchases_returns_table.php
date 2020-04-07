<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchIdToAccountingPurchasesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_purchases_returns', function (Blueprint $table) {


            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')
                ->on('accounting_branches')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('safe_id')->nullable();
            $table->foreign('safe_id')->references('id')
                ->on('accounting_safes')->onDelete('cascade')
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
        Schema::table('accounting_purchases_returns', function (Blueprint $table) {
            //
        });
    }
}
