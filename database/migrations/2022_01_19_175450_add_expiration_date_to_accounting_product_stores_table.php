<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpirationDateToAccountingProductStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_purchases_items', function (Blueprint $table) {
            $table->date('expired_at')->after('product_id')->nullable()->index();
        });


        Schema::table('accounting_product_stores', function (Blueprint $table) {
            $table->date('expired_at')->after('product_id')->nullable()->index();
        });

        Schema::table('accounting_product_store_logs', function (Blueprint $table) {
            $table->date('expired_at')->after('accounting_product_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_product_stores', function (Blueprint $table) {
            $table->dropIndex(['expired_at']);
            $table->dropColumn('expired_at');
        });

        Schema::table('accounting_product_store_logs', function (Blueprint $table) {
            $table->dropIndex(['expired_at']);
            $table->dropColumn('expired_at');

        });
    }
}
