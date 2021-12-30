<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingProductStoreLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_product_store_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('accounting_product_store_id')->nullable();
            $table->unsignedInteger('accounting_product_id')->nullable();
            $table->unsignedInteger('unit_id')->nullable();
            $table->morphs('dispatcher', 'dispatcher_index');
            $table->decimal('price', 8, 4)->nullable();
            $table->BigInteger('amount')->nullable();
            $table->enum('type', ['in','out'])->nullable();
            $table->bigInteger('amount_by_type')->virtualAs("IF(type='out',amount*-1,amount)");
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
        Schema::dropIfExists('accounting_product_store_logs');
    }
}
