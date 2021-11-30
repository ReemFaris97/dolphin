<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingProductionLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_production_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accounting_company_id');
            $table->string('name');
            $table->foreign('accounting_company_id')->references('id')
                ->on('accounting_companies')->onDelete('cascade')
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
        Schema::dropIfExists('accounting_production_lines');
    }
}
