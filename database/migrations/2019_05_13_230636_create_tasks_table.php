<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->enum('type', ['period', 'date', 'after_task', 'depends']);
            $table->longText('description');
            $table->string('duration');
            $table->date('date');
            $table->time('time_from');
            $table->time('time_to');
            $table->enum('equation_mark', ['<', '>', '=', '<=', '>='])->nullable();
            $table->enum('rate', ['1', '2', '3', '4', '5'])->nullable();
            $table->string('period');
            $table->bigInteger('after_task_id')->unsigned();
            $table->bigInteger('clause_id')->nullable()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('reviewer_id')->unsigned();

            $table->timestamp('finished_at')->nullable();
            $table->timestamp('reviewer_finished_at')->nullable();
            $table->softDeletes();
            $table->timestamps();


            //constraints
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('reviewer_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('after_task_id')->references('id')->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('clause_id')->references('id')->on('clauses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');

    }


}
