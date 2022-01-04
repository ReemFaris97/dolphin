<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInAccountingSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_suppliers', function (Blueprint $table) {
            $table->string('commercial_record')->nullable();
            $table->string('commercial_image')->nullable();
            $table->string('licence_image')->nullable();
            $table->boolean('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_suppliers', function (Blueprint $table) {
            $table->dropColumn('commercial_record','commercial_image','licence_image','is_active');
        });
    }
}
