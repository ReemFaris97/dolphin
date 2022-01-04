<?php

use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSuppliersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers_products', function (Blueprint $table) {
            $table->foreignIdFor(AccountingSupplier::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AccountingCompany::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers_products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('accounting_supplier_id');
            $table->dropConstrainedForeignId('accounting_company_id');
        });
    }
}
