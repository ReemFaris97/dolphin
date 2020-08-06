<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEntryStartToAccountingSettingsTable extends Migration
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
                    [ 'id' => '69',
                        'name' => 'entry_code',
                        'type' => 'text',
                        'value'=>'1',
                        'page' => 'القيود المحاسبيه',
                        'slug' => 'accounting_entries',
                        'title' => 'بداية  ترقيم الكود',
                        'accounting_type'=>'Acc_entries',

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
