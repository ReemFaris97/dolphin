<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscardProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discard_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('discard_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price');
            $table->enum('type',['discard','switch']);
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
        Schema::dropIfExists('discard_products');
    }
}
