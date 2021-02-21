<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_bonus_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('typeable');
            $table->enum('type',['bonus','discount']);
            $table->date('date');
            $table->decimal('value');
            $table->text('notes')->nullable();
            $table->text('reason')->nullable();

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
        Schema::dropIfExists('bonus_discounts');
    }
}
