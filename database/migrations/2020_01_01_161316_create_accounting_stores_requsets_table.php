<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingStoresRequsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_stores_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('status',['pending','accepted','refused'])->default('pending');
            $table->text('refused_reason')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


            $table->unsignedBigInteger('store_form')->nullable();
            $table->foreign('store_form')->references('id')
                ->on('accounting_stores')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('store_to')->nullable();
            $table->foreign('store_to')->references('id')
                ->on('accounting_stores')->onDelete('cascade')
                ->onUpdate('cascade');


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
        Schema::dropIfExists('accounting_stores_requsets');
    }
}
