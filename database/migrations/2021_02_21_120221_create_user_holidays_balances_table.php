<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHolidaysBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_holiday_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('typeable');
            $table->unsignedBigInteger('holiday_id')->index();
            $table->foreign('holiday_id')->references('id')->on('accounting_holidays')->onDelete('cascade');
            $table->integer('days');
            $table->enum('type',['balance','request'])->default('balance');
            $table->timestamp('start_date')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('user_holidays_balances');
    }
}
