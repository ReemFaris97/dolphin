<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisaToRouteTripReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_trip_reports', function (Blueprint $table) {
            $table->decimal('visa', 10, 5)->default(0)->nullable()->after('cash');
            $table->decimal('total_money')->after('visa')->nullable()->virtualAs('visa + cash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_trip_reports', function (Blueprint $table) {
            $table->dropColumn(['visa', 'total_money']);
        });
    }
}
