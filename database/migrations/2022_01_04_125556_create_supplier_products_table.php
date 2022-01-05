<?php

use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_supplier_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingProduct::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AccountingSupplier::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('supplier_products');
    }
}
