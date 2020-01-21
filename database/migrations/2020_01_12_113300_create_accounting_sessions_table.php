<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('device_id')->nullable();
                $table->foreign('device_id')->references('id')
                    ->on('accounting_devices')->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->unsignedBigInteger('shift_id')->nullable();
                $table->foreign('shift_id')->references('id')
                    ->on('accounting_branch_shifts')->onDelete('cascade')
                    ->onUpdate('cascade');


                    $table->unsignedBigInteger('user_id')->nullable();
                    $table->foreign('user_id')->references('id')
                        ->on('users')->onDelete('cascade')
                        ->onUpdate('cascade');
                        $table->string('password');


                    $table->string('code')->nullable();


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
        Schema::dropIfExists('accounting_sessions');
    }
}
