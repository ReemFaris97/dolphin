<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedbigInteger('expenditure_clause_id');

            $table->foreign('expenditure_clause_id')->references('id')
                ->on('expenditure_clauses')->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedbigInteger('expenditure_type_id');

            $table->foreign('expenditure_type_id')->references('id')
                ->on('expenditure_types')->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedbigInteger('user_id');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');


            $table->date('date');
            $table->time('time');

            $table->decimal('amount');
            $table->string('image')->nullable();

            $table->text('notes')->nullable();

            $table->string('reader_name')->nullable();
            $table->string('reader_number')->nullable();
            $table->string('reader_image')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
