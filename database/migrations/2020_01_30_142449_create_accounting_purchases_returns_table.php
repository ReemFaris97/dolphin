<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingPurchasesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_purchases_returns', function (Blueprint $table) {
            $table->bigIncrements('id');



                $table->unsignedBigInteger('purchase_id')->nullable();
                $table->foreign('purchase_id')->references('id')
                    ->on('accounting_purchases')->onDelete('cascade')
                    ->onUpdate('cascade');

                    $table->string('total')->nullable();

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
        Schema::dropIfExists('accounting_purchases_returns');
    }
}
