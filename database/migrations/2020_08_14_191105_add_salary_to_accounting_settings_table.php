<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryToAccountingSettingsTable extends Migration
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
                    [ 'id' => '72',
                        'name' => 'accounting_salary_id',
                        'type' => 'select',
                        'value'=>'1',
                        'page' => 'تعين حسابات الاجور',
                        'slug' => 'accounting_salaries',
                        'title' => 'اختر حساب الاجور والمرتبات',
                        'accounting_type'=>'Acc_salaries',

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
