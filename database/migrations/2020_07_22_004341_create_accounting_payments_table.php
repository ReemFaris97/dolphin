<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
          $table->enum('type',['safe','bank'])->nullable();
            $table->unsignedBigInteger('safe_id')->nullable();
            $table->foreign('safe_id')->references('id')
                ->on('accounting_safes')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')
                ->on('accounting_banks')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('active')->default('1')->nullable();

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
        Schema::dropIfExists('accounting_payments');
    }
}
