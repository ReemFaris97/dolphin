<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditDistributorIdToStoreTransferRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_transfer_requests', function (Blueprint $table) {
            $table->unsignedbigInteger('distributor_id')->nullable()->change();
            $table->unsignedbigInteger('sender_id')->nullable()->change();
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
            $table->unsignedbigInteger('distributor_id')->change();
            $table->unsignedbigInteger('sender_id')->change();
        });
    }
}
