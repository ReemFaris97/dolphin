<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnsInSupplierBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_bills', function (Blueprint $table) {
            DB::statement('ALTER TABLE supplier_bills CHANGE COLUMN  payment_method payment_method ENUM("cash","bank_transfer","check") NOT NULL DEFAULT "cash"');
            $table->date('transfer_date')->after('amount_rest')->nullable();
            $table->string('transfer_number')->after('transfer_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('check_number')->nullable();
            $table->date('check_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_bills', function (Blueprint $table) {
            $table->dropColumn(['payment_method','transfer_date','transfer_number','bank_name','check_number','check_date']);
        });
    }
}
