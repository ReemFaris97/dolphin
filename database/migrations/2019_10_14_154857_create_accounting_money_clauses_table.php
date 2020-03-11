<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingMoneyClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_money_clauses', function (Blueprint $table) {
            $table->bigIncrements('id');

            // $table->string('ar_name');
            // $table->string('en_name')->nullable();
            // $table->string('en_description')->nullable();
            // $table->string('ar_description')->nullable();
            $table->string('sanad_num')->nullable();

            $table->decimal('default')->default(0);
            $table->enum('type',['revenue','expenses']);

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
        Schema::dropIfExists('accounting_money_clauses');
    }
}
