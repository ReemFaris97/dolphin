<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingBenodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_benods', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('clause_id')->nullable();
            $table->foreign('clause_id')->references('id')
                ->on('accounting_money_clauses')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->date('date')->nullable();
            $table->string('sanad_num')->nullable();
            $table->enum('type',['revenue','expenses']);
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('accounting_benods');
    }
}
