<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSafesTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_safes_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('safe_form_id')->nullable();
            $table->foreign('safe_form_id')->references('id')
                ->on('accounting_safes')->onDelete('cascade')
                ->onUpdate('cascade');

                $table->unsignedBigInteger('safe_to_id')->nullable();
                $table->foreign('safe_to_id')->references('id')
                    ->on('accounting_safes')->onDelete('cascade')
                    ->onUpdate('cascade');

                    $table->string('amount')->nullable();
                    $table->text('notes')->nullable();

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
        Schema::dropIfExists('accounting_safes_transactions');
    }
}
