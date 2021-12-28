<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokensToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers_users', function (Blueprint $table) {
            $table->string('fcm_token_android')->nullable();
            $table->string('fcm_token_ios')->nullable();
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
            $table->dropColumn('fcm_token_android','fcm_token_ios');
        });
    }
}
