<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingUsersSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_users_salary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedBigInteger('title_id')->nullable();
            $table->foreign('title_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
                $table->decimal('salary')->nullable();
                $table->decimal('bouns')->nullable();
                $table->decimal('total_salary')->nullable();
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
        Schema::dropIfExists('accounting_users_salary');
    }
}
