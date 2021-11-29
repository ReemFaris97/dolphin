<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountIdToProductionLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_production_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->index()->nullable();
            $table->foreign('account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_lines', function (Blueprint $table) {
             //
        });
    }
}
