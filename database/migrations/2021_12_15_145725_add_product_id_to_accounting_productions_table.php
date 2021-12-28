<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToAccountingProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_productions', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
//            $table->foreign('product_id')->references('id')
//                ->on('accounting_products')->onDelete('cascade')
//                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_productions', function (Blueprint $table) {
            //
        });
    }
}
