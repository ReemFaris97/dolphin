<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComponentIdInAccountingProductComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_product_components', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingProduct::class, 'component_id')->references('id')->on('accounting_products')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_product_components', function (Blueprint $table) {
            $table->dropConstrainedForeignId('component_id');
        });
    }
}
