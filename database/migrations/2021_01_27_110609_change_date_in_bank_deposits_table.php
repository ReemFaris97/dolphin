<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDateInBankDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_deposits', function (Blueprint $table) {
            $table->dropColumn('deposit_date');
        });
        Schema::table('bank_deposits', function (Blueprint $table) {
            $table->timestamp('deposit_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_deposits', function (Blueprint $table) {
            //
        });
    }
}
