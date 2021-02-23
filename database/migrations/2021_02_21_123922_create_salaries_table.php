<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('typeable');
            $table->decimal('salary');
            $table->decimal('allowance')->default(0);
            $table->decimal('bonus')->default(0);
            $table->decimal('discount')->default(0);
            $table->date('date');
            $table->decimal('total');
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
        Schema::dropIfExists('salaries');
    }
}
