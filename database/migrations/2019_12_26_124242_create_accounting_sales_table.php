<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_sales', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->decimal('amount')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('total')->nullable();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')
                ->on('accounting_clients')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->enum('payment',['cash','agel','card'])->nullable();

            $table->decimal('payed')->nullable();
            $table->decimal('debts')->nullable();
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
        Schema::dropIfExists('accounting_sales');
    }
}
