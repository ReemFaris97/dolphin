<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArrangeToDistributorRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributor_routes', function (Blueprint $table) {
            $table->string('arrange')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributor_routes', function (Blueprint $table) {
            $table->dropIndex(['arrange']);
            $table->dropColumn('arrange');

        });
    }
}
