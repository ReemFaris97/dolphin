<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToProductComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_product_components', function (Blueprint $table) {
            $table->boolean('is_production')->index()->default(1);
            $table->unsignedBigInteger('unit_id')->index()->nullable();
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
            $table->dropIndex(['is_production']);
            $table->dropIndex(['unit_id']);
            $table->dropColumn('is_production','unit_id');
        });
    }
}
