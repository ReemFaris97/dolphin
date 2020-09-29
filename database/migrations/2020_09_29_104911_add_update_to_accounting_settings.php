<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateToAccountingSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_settings', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::table('accounting_settings')->insert(
                array(
                    [ 'id' => '80',
                        'name' => 'rounding_number',
                        'type' => 'text',
                        'value'=>'2',
                        'page' => 'الاعدادت  العامة',
                        'slug' => 'general',
                        'title' => 'عدد التقريب',

                    ],



                )
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_settings', function (Blueprint $table) {
            //
        });
    }
}
