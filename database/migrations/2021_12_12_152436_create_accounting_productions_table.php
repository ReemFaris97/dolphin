<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')
                ->on('accounting_companies')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('production_line_id');
            $table->foreign('production_line_id')->references('id')
                ->on('accounting_production_lines')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->enum('status', ['new', 'pending','finished'])->default('new');

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
        Schema::dropIfExists('accounting_productions');
    }
}
