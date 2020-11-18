<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreTransferRequestIdToProductQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_quantities', function (Blueprint $table) {
            $table->unsignedBigInteger('store_transfer_request_id')->nullable()->index();
        });
        DB::statement("ALTER TABLE `product_quantities` CHANGE `type` `type` ENUM('in','out','damaged') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_quantities', function (Blueprint $table) {
            $table->dropIndex(['store_transfer_request_id']);
            $table->dropColumn('store_transfer_request_id');
        });
        DB::statement("ALTER TABLE `product_quantities` CHANGE `type` `type` ENUM('in','out') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in';");

    }
}
