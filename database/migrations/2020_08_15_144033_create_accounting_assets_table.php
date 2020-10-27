<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')
                ->on('accounting_currencies')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->decimal('purchase_price')->nullable();
           $table->date('purchase_date')->nullable();
           $table->unsignedBigInteger('payment_id')->nullable();
           $table->foreign('payment_id')->references('id')
               ->on('accounting_payments')->onDelete('cascade')
               ->onUpdate('cascade');

               $table->unsignedBigInteger('account_id')->nullable();
               $table->foreign('account_id')->references('id')
                   ->on('accounting_accounts')->onDelete('cascade')
                   ->onUpdate('cascade');

                   $table->date('damage_start_date')->nullable();
                   $table->date('damage_end_date')->nullable();
                   $table->enum('damage_type',['fixed_installment'])->nullable();
                   $table->string('damage_period')->nullable();
                   $table->enum('damage_period_type',['hour','day','week','month','year'])->nullable();
                   $table->decimal('damage_price')->nullable();
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
        Schema::dropIfExists('accounting_assets');
    }
}
