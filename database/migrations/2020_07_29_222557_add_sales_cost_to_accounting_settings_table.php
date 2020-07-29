<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalesCostToAccountingSettingsTable extends Migration
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
                    [ 'id' => '67',
                        'name' => 'accounting_sales_cost_id',
                        'type' => 'select',
                        'value'=>'1',
                        'page' => 'اعاده تعين حسابات المبيعات',
                        'slug' => 'accounting_sales',
                        'title' => 'اختر حساب تكلفة المبيعات',
                        'accounting_type'=>'Acc_sales_cost',

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
