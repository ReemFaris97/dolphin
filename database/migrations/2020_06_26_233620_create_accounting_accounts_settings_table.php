<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingAccountsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_accounts_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')
                ->on('accounting_accounts')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('status',['increase','serial'])->nullable();
            $table->string('main_code')->nullable();
            $table->string('increased_number')->nullable();
            $table->boolean('automatic')->nullable();

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
        Schema::dropIfExists('accounting_accounts_settings');
    }
}
