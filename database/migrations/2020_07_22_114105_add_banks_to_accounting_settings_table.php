<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanksToAccountingSettingsTable extends Migration
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
                    [ 'id' => '65',
                        'name' => 'accounting_bank_id',
                        'type' => 'select',
                        'value'=>'1',
                        'page' => 'تعين حسابات البنوك والصناديق',
                        'slug' => 'accounting_banks_safes',
                        'title' => 'اختر البنك',
                        'accounting_type'=>'Acc_banks_safes',

                    ],
                    [ 'id' => '66',
                        'name' => 'accounting_safe_id',
                        'type' => 'select',
                        'value'=>'1',
                        'page' => 'تعين حسابات البنوك والصناديق',
                        'slug' => 'accounting_banks_safes',
                        'title' => 'اختر الصندوق',
                        'accounting_type'=>'Acc_banks_safes',

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
