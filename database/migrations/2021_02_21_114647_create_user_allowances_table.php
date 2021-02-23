<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_user_allowances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('typeable');
            $table->unsignedBigInteger('allowance_id');
            $table->foreign('allowance_id')
                ->references('id')
                ->on('accounting_allowances')
                ->onDelete('cascade');
            $table->decimal('value')->default(0);
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
        Schema::dropIfExists('user_allowances');
    }
}
