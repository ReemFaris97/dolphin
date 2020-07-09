<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToAccountingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE accounting_accounts MODIFY COLUMN kind ENUM('main', 'sub', 'following_main')");

//        Schema::table('accounting_accounts', function (Blueprint $table) {
//            $table->enum('kind',['main','sub','following_main'])->nullable()->change();
//
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_accounts', function (Blueprint $table) {
            //
        });
    }
}
