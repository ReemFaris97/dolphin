<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchIdToAccountingSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_sales', function (Blueprint $table) {

     $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')
                ->on('accounting_sessions')->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')
                ->on('accounting_branches')->onDelete('cascade')
                ->onUpdate('cascade');


        $table->unsignedBigInteger('company_id')->nullable();
        $table->foreign('company_id')->references('id')
            ->on('accounting_companies')->onDelete('cascade')
            ->onUpdate('cascade');


    $table->unsignedBigInteger('store_id')->nullable();
    $table->foreign('store_id')->references('id')
        ->on('accounting_stores')->onDelete('cascade')
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
        Schema::table('accounting_sales', function (Blueprint $table) {
            //
        });
    }
}
