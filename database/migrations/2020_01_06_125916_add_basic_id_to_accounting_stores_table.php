<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBasicIdToAccountingStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_stores', function (Blueprint $table) {

            $table->unsignedBigInteger('basic_store_id')->nullable();
            $table->foreign('basic_store_id')->references('id')
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
        Schema::table('accounting_stores', function (Blueprint $table) {
            //
        });
    }
}
