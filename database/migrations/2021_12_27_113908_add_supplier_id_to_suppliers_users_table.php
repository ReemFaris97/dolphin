<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierIdToSuppliersUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers_users', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingSupplier::class,'supplier_id')->constrained('accounting_suppliers')->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers_users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supplier_id');
        });
    }
}
