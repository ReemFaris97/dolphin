<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_products', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->text('name');

            $table->text('description')->nullable();

            $table->enum('type',['store','service','offer','creation','product_expiration']);

            $table->boolean('is_active')->default(1);

            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('category_id')->references('id')
                ->on('accounting_product_categories')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('cell_id')->nullable();

            $table->foreign('cell_id')->references('id')
                ->on('accounting_column_cells')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('bar_code')->nullable();

            $table->string('main_unit');

            $table->decimal('selling_price');

            $table->decimal('purchasing_price');

            $table->decimal('min_quantity');

            $table->decimal('max_quantity');

            $table->date('expired_at')->nullable();

            $table->string('image')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('width')->nullable();

            $table->integer('num_days_recession')->nullable();

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
        Schema::dropIfExists('accounting_products');
    }
}
