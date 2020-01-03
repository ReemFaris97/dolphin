<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropOfferIdColumnFromSupplierBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_bills', function (Blueprint $table) {
            $table->dropForeign('offer_id');
            $table->dropColumn('offer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_bills', function (Blueprint $table) {
            //
        });
    }
}
