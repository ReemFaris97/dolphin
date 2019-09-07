<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviewersModificationsToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('task_users', function (Blueprint $table) {

            $table->unsignedbigInteger('finisher_id');
            $table->unsignedbigInteger('rater_id');


            $table->dropColumn('time_from');
            $table->dropColumn('time_to');

            $table->string('task_duration');

            $table->foreign('rater_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('finisher_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_reviewer_id_foreign');

            $table->unsignedbigInteger('finisher_id');
            $table->unsignedbigInteger('rater_id');


            $table->string('task_duration');

            $table->foreign('finisher_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('rater_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->renameColumn('clause_amout','clause_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_users', function (Blueprint $table) {

            $table->dropForeign('finisher_id');
            $table->dropForeign('rater_id');

            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();

            $table->dropColumn('task_duration');

        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedbigInteger('reviewer_id');

            $table->foreign('reviewer_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->dropForeign('finisher_id');
            $table->dropForeign('rater_id');

            $table->time('time_from')->nullable();

            $table->dropColumn('duration');
            $table->dropColumn('from');

            $table->renameColumn('clause_amount','clause_amout');

        });
    }
}
