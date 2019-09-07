<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedbigInteger('store_id');
            $table->decimal('quantity_per_unit');
            $table->decimal('min_quantity');
            $table->decimal('max_quantity');
            $table->decimal('price');
            $table->text('bar_code')->nullable();
            $table->string('image')->nullable();
            $table->date('expired_at')->nullable();
            $table->foreign('store_id')->references('id')
                ->on('stores')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
