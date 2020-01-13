<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ar_name');
            $table->string('en_name')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->morphs('model');
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
        Schema::dropIfExists('accounting_stores');
    }
}
