<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyToAccountingProductCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')
                ->on('accounting_companies')->onDelete('cascade')
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
        Schema::table('accounting_product_categories', function (Blueprint $table) {
            //
        });
    }
}
