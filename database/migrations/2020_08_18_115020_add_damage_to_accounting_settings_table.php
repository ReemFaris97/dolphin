<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDamageToAccountingSettingsTable extends Migration
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
                        [ 'id' => '73',
                            'name' => 'accounting_damage_asset_id',
                            'type' => 'select',
                            'value'=>'1',
                            'page' => 'تعين حسابات الاهلاك',
                            'slug' => 'accounting_damages',
                            'title' => 'اختر حساب الاهلاك',
                            'accounting_type'=>'Acc_damages',

                        ]

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
