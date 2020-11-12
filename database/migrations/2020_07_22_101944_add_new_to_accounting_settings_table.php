<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewToAccountingSettingsTable extends Migration
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
                    [ 'id' => '64',
                        'name' => 'accounting_payment_id',
                        'type' => 'radio',
                        'value'=>'1',
                        'page' => 'تعين خيارات الدفع',
                        'slug' => 'accounting_payment',
                        'title' => 'طريقه الدفع الافتراضية',
                         'accounting_type'=>'Acc_payment',

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
