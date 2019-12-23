<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_clients', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->string('fax')->nullable();
            $table->boolean('category')->nullable();

            $table->string('tax_number')->nullable();
            $table->string('commercial_registration_no')->nullable();

            $table->enum('type_price',['wholesale','sale'])->nullable();

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
        Schema::dropIfExists('accounting_clients');
    }
}
