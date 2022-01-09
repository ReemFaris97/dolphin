<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResetColumnsToSuppliersUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers_users', function (Blueprint $table) {
            $table->string('reset_code')->nullable();
            $table->datetime('reset_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers_users', function (Blueprint $table) {
            $table->dropcolumn('reset_code','reset_at');
        });
    }
}
