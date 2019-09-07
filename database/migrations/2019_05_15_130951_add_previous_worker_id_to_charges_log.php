<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreviousWorkerIdToChargesLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charge_logs', function (Blueprint $table) {
            $table->bigInteger('previous_worker_id')->unsigned()->nullable();

            $table->foreign('previous_worker_id')->references('id')
                ->on('users')->onDelete('cascade')
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
        Schema::table('charges_log', function (Blueprint $table) {
            $table->dropForeign(['previous_worker_id']);
        });
    }
}
