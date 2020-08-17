<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingCustodyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_custody_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('operation_name')->nullable();
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->foreign('asset_id')->references('id')
                ->on('accounting_assets')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->decimal('amount')->nullable();
            $table->decimal('amount_asset_after')->nullable();
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('accounting_custody_logs');
    }
}
