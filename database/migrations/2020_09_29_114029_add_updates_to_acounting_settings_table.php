<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatesToAcountingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acounting_settings', function (Blueprint $table) {

            \Illuminate\Support\Facades\DB::table('accounting_settings')->insert(
                array(
                    [ 'id' => '81',
                        'name' => 'free_taxs',
                        'type' => 'radio',
                        'value'=>'1',
                        'page' => 'فاتوره  المشتريات',
                        'slug' => 'purchases_bill',
                        'title' => ' الاعفاء من الضرائب',

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
        Schema::table('acounting_settings', function (Blueprint $table) {
            //
        });
    }
}
