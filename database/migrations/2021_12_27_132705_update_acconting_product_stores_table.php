<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccontingProductStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_product_stores', function (Blueprint $table) {
           $table->nullableMorphs('added_from');
           $table->boolean('type')->default(0)->comment('0=>add ,1=>remove')->change()
           ;
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
           $table->dropMorphs('added_from');
           $table->dropColumn('type');
        });
    }
}
