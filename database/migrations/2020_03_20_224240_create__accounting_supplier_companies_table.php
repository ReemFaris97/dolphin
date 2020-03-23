<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSupplierCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_suppliers_companies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')
                ->on('accounting_suppliers')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')
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
        Schema::dropIfExists('_accounting_supplier_companies');
    }
}
