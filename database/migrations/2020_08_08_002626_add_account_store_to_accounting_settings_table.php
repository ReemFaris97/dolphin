<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountStoreToAccountingSettingsTable extends Migration
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
                    [ 'id' => '70',
                        'name' => 'automatic_stores',
                        'type' => 'check',
                        'value'=>'0',
                        'page' => 'اعاده تعين حسابات المخزون',
                        'slug' => 'accounting_stores',
                        'title' => 'تعين تلقائ',
                        'accounting_type'=>'Acc_stores',

                    ],
                    [ 'id' => '71',
                        'name' => 'accounting_id_stores',
                        'type' => 'select',
                        'value'=>'53',
                        'page' => 'اعاده تعين حسابات المخزون',
                        'slug' => 'accounting_stores',
                        'title' => 'حساب المخزون',
                        'accounting_type'=>'Acc_stores',

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
