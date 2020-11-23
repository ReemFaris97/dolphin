<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToRouteReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_reports', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropColumn('user_id');

        });
    }
}
