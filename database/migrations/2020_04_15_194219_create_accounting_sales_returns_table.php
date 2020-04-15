<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSalesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_sales_returns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')
                ->on('accounting_sales')->onDelete('cascade')
                ->onUpdate('cascade');


            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->string('bill_num')->nullable();
            $table->string('totalTaxs')->nullable();
            $table->enum('discount_type',['percentage','amount'])->nullable();
            $table->enum('payment',['cash','agel'])->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')
                ->on('accounting_sessions')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')
                ->on('accounting_clients')->onDelete('cascade')
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
        Schema::dropIfExists('accounting_sales_returns');
    }
}
