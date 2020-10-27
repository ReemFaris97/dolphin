<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatesToAccountingSettingsTable extends Migration
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
                    [ 'id' => '76',
                        'name' => 'accounting_discount_id',
                        'type' => 'select',
                        'value'=>'1',
                        'page' => 'تعين حساب الخصوم',
                        'slug' => 'accounting_purchases',
                        'title' => 'اختر الحساب',
                        'accounting_type'=>'Acc_discounts',

                    ],
                    [ 'id' => '77',
                        'name' => 'accounting_tax_id',
                        'type' => 'select',
                        'value'=>'1',
                        'page' => 'تعين حساب الضرائب',
                        'slug' => 'accounting_purchases',
                        'title' => 'اختر الحساب',
                        'accounting_type'=>'Acc_discounts',
                    ],
                    [ 'id' => '78',
                    'name' => 'accounting_cash_id',
                    'type' => 'select',
                    'value'=>'1',
                    'page' => 'تعين حساب السداد النقدى',
                    'slug' => 'accounting_purchases',
                    'title' => 'اختر الحساب',
                    'accounting_type'=>'Acc_discounts',
                ],

                [ 'id' => '79',
                'name' => 'accounting_gifts_id',
                'type' => 'select',
                'value'=>'1',
                'page' => 'تعين حساب هدايا المشتريات',
                'slug' => 'accounting_purchases',
                'title' => 'اختر الحساب',
                'accounting_type'=>'Acc_discounts',
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
