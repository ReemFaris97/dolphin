<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_templates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('first_account_id')->index()->nullable();
            $table->foreign('first_account_id')->references('id')->on('accounting_accounts')->onDelete('cascade');


            $table->unsignedBigInteger('second_account_id')->index()->nullable();
            $table->foreign('second_account_id')->references('id')->on('accounting_accounts')->onDelete('cascade');


            $table->string('result')->nullable();

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
        Schema::dropIfExists('accounting_templates');
    }
}
