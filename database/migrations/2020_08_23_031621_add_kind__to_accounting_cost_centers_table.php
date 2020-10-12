<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKindToAccountingCostCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_cost_centers', function (Blueprint $table) {
            $table->enum('kind',['main','sub','following_main'])->nullable();

            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')->references('id')
                ->on('accounting_cost_centers')->onDelete('cascade')
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
        Schema::table('accounting_cost_centers', function (Blueprint $table) {
            //
        });
    }
}
