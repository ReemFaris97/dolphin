<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBondToAccountingStoresRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_stores_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('bond_id')->nullable();
            $table->foreign('bond_id')->references('id')
                ->on('accounting_bonds')->onDelete('cascade')
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
        Schema::table('accounting_stores_requests', function (Blueprint $table) {
            //
        });
    }
}
