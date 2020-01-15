<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBandToAccountingProductTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_product_taxes', function (Blueprint $table) {

            $table->unsignedBigInteger('tax_band_id')->nullable();
            $table->foreign('tax_band_id')->references('id')
                ->on('accounting_tax_bands')->onDelete('cascade')
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
        Schema::table('accounting_product_taxes', function (Blueprint $table) {
            //
        });
    }
}
