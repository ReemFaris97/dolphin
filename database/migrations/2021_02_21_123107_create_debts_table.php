<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_debts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('typeable');
            $table->timestamp('date');
            $table->decimal('value');
            $table->string('reason')->nullable();
            $table->integer('payments_count');
            $table->timestamp('pay_from')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('payed')->default(0);
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
        Schema::dropIfExists('debts');
    }
}
