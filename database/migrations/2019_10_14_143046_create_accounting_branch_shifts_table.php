<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingBranchShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_branch_shifts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')
                ->on('accounting_branches')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name');
            $table->time('from');
            $table->time('to');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_branch_shifts');
    }
}
