<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_funds', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('name_en')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->boolean('is_bank')->default(0);
            $table->longText('description')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->boolean('type')->default(0);
            $table->nullableMorphs('created_by');
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
        Schema::dropIfExists('accounting_funds');
    }
}
