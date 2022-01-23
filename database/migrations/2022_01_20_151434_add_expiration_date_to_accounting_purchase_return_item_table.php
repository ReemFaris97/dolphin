<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpirationDateToAccountingPurchaseReturnItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_purchase_return_items', function (Blueprint $table) {
            $table->date('expired_at')->nullable()->after('product_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_purchase_return_items', function (Blueprint $table) {
           $table->dropIndex(['expired_at']);
           $table->dropColumn('expired_at');
        });
    }
}
