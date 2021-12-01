<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDecimalToStringAtProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_products', function (Blueprint $table) {
            $table->string('selling_price')->change();
            $table->string('purchasing_price')->change();
        });

        Schema::table('accounting_products_subUnits', function (Blueprint $table) {
            $table->string('selling_price')->change();
            $table->string('purchasing_price')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('string_at_products', function (Blueprint $table) {
            //
        });
    }
}
