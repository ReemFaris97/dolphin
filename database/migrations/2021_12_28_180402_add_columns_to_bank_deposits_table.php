<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBankDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_deposits', function (Blueprint $table) {
            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->boolean('confirmed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_deposits', function (Blueprint $table) {
            $table->dropColumn(['from','to','confirmed_at']);
        });
    }
}
