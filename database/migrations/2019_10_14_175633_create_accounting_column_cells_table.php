<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingColumnCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_column_cells', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->string('name');
            $table->unsignedBigInteger('column_id');

            $table->foreign('column_id')->references('id')
                ->on('accounting_face_columns')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->decimal('width');
            $table->decimal('height');

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
        Schema::dropIfExists('accounting_column_cells');
    }
}
