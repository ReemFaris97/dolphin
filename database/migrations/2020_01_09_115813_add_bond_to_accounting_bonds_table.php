<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBondToAccountingBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_bonds', function (Blueprint $table) {

            $table->unsignedBigInteger('store_to')->nullable();
            $table->foreign('store_to')->references('id')
                ->on('accounting_stores')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('store_form')->nullable();
            $table->foreign('store_form')->references('id')
                ->on('accounting_stores')->onDelete('cascade')
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
        Schema::table('accounting_bonds', function (Blueprint $table) {
            //
        });
    }
}
