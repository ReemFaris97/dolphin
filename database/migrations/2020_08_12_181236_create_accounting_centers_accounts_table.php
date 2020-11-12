<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingCentersAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_centers_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
                ->onUpdate('cascade');

                $table->unsignedBigInteger('center_id')->nullable();
                $table->foreign('center_id')->references('id')
                    ->on('accounting_cost_centers')->onDelete('cascade')
                    ->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_centers_accounts');
    }
}
