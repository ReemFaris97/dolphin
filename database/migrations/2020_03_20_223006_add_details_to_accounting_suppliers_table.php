<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsToAccountingSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_suppliers', function (Blueprint $table) {
            $table->string('password')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')
                ->on('accounting_banks')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('bank_account_number')->nullable();
            $table->string('tax_number')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_suppliers', function (Blueprint $table) {
            //
        });
    }
}
