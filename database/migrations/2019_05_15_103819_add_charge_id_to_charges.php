<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChargeIdToCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charge_logs', function (Blueprint $table) {
            $table->bigInteger('charge_id')->unsigned();

            //castrations
            $table->foreign('charge_id')->references('id')
                ->on('charges')->onDelete('cascade')
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
        Schema::table('charge_logs', function (Blueprint $table) {
            $table->dropForeign(['charge_id']);
        });
    }
}
