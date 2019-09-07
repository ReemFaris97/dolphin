<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /* 'duration', 'date', 'time_from', 'time_to'*/
    public function up()
    {
        Schema::create('task_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('task_id');
            $table->unsignedbigInteger('user_id');
            $table->timestamp('date')->nullable();
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();

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
        Schema::dropIfExists('task_users');
    }
}
