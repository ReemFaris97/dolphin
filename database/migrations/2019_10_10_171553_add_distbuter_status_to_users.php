<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDistbuterStatusToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('distributor_status',['commission','reward','together'])->nullable();
            $table->string('settle_commission')->nullable();
            $table->string('sell_commission')->nullable();
            $table->string('reword_value')->nullable();

            $table->unsignedbigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')
                ->on('stores')->onDelete('cascade')
                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
