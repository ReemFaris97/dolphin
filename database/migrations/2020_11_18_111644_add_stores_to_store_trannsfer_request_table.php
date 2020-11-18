<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoresToStoreTrannsferRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_transfer_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('sender_store_id')->index()->nullable();
            $table->unsignedBigInteger('distributor_store_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_transfer_requests', function (Blueprint $table) {
            $table->dropIndex(['sender_store_id', 'distributor_store_id']);
            $table->dropColumn(['sender_store_id', 'distributor_store_id']);
        });
    }
}
