<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClauseAmountToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::table('tasks', function (Blueprint $table) {
            $table->string('duration')->nullable()->change();
            $table->date('date')->nullable()->change();
            $table->time('time_from')->nullable()->change();
            $table->time('time_to')->nullable()->change();
            $table->bigInteger('user_id')->unsigned()->nullable()->change();
            $table->bigInteger('after_task_id')->unsigned()->nullable()->change();
            $table->string('period')->nullable()->change();
            $table->integer('clause_amout')->nullable();
            $table->unsignedBigInteger('finished_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
}
