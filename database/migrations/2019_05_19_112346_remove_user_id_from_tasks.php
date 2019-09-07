<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserIdFromTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_user_id_foreign');
            $table->dropForeign('tasks_finisher_id_foreign');
            $table->dropForeign('tasks_rater_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('finisher_id');
            $table->dropColumn('finished_at');
            $table->dropColumn('reviewer_finished_at');
            $table->dropColumn('rater_id');
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
