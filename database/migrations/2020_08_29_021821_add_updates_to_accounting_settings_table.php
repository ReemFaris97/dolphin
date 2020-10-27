<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
          $unit_price_enable=   DB::table('accounting_settings')->where('name','unit_price_before_enable')->update([
              'name'=>'unit_price_enable',
              'title'=>'اظهار سعرالوحده ',
          ]);


          $gifts_enable=   DB::table('accounting_settings')->where('name','unit_price_after_enable')->update([
              'name'=>'gifts_enable',
              'title'=>'اظهار  الهدايا ',
          ]);
          $total_enable=   DB::table('accounting_settings')->where('name','total_price_before_enable')->update([
              'name'=>'total_enable',
              'title'=>'اظهار  الاجمالى ',
          ]);
          $total_taxs_enable= DB::table('accounting_settings')->where('name','total_price_after_enable')->update([
              'name'=>'total_taxes_enable',
              'title'=>'اظهارقيمة الضريبة ',
          ]);


          \Illuminate\Support\Facades\DB::table('accounting_settings')->insert(
            array(
                [ 'id' => '74',
                    'name' => 'total_pure_enable',
                    'type' => 'radio',
                    'value'=>'1',
                    'page' => 'فاتوره  المشتريات',
                    'slug' => 'purchases_bill',
                    'title' => ' اظهار  صافى الاجمالى',

            ],
            [ 'id' => '75',
                    'name' => 'operations_enable',
                    'type' => 'radio',
                    'value'=>'1',
                    'page' => 'فاتوره  المشتريات',
                    'slug' => 'purchases_bill',
                    'title' => ' اظهار العمليات',

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
