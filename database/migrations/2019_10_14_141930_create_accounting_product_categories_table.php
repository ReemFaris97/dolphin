<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ar_name')->unique();
            $table->string('en_name')->nullable()->unique();
            $table->string('ar_description')->nullable();
            $table->string('en_description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_product_categories');
    }
}
