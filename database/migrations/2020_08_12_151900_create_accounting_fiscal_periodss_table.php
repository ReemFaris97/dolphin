<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingFiscalPeriodssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_fiscal_periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('year_id')->nullable();
            $table->foreign('year_id')->references('id')
                ->on('accounting_fiscal_years')->onDelete('cascade')
                ->onUpdate('cascade');
                $table->enum('type',['manual','automatic'])->nullable();
                $table->string('name')->nullable();
                $table->date('from')->nullable();
                $table->date('to')->nullable();
                $table->enum('duration',['monthly','quarterly','half','yearly'])->nullable();
                $table->enum('status',['opened','closed'])->default('opened');
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
        Schema::dropIfExists('accounting_fiscal_periodss');
    }
}
