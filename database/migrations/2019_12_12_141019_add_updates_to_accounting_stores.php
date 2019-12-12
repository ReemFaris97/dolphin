<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatesToAccountingStores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_stores', function (Blueprint $table) {

            $table->string('code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('width')->nullable();
            $table->boolean('status')->default(1);
            $table->string('cost')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_stores', function (Blueprint $table) {
            //
        });
    }
}
