<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComulToAccountingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_products', function (Blueprint $table) {

            $table->unsignedBigInteger('column_id')->nullable();
            $table->foreign('column_id')->references('id')
            ->on('accounting_face_columns')->onDelete('cascade')
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
        Schema::table('accounting_products', function (Blueprint $table) {



        });
    }
}
