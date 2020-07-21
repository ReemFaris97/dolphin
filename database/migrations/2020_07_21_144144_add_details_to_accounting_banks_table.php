<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsToAccountingBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_banks', function (Blueprint $table) {
            $table->string('account_name')->nullable();
            $table->string('account_num')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')
                ->on('accounting_currencies')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('active')->default('1')->nullable();
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_banks', function (Blueprint $table) {
            //
        });
    }
}
