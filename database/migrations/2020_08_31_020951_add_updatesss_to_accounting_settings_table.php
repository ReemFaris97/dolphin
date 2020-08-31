<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatesssToAccountingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_settings', function (Blueprint $table) {

            $unit_price_enable=DB::table('accounting_settings')->where('name','unit_price_after_enable_sales')->update([
                'name'=>'unit_price_enable_sales',
                'title'=>'اظهار سعرالوحده ',
            ]);
            $total_enable=DB::table('accounting_settings')->where('name','total_price_after_enable_sales')->update([
                'name'=>'total_price_enable_sales',
                'title'=>'اظهار صافى الاجمالى ',
            ]);

            $aa=DB::table('accounting_settings')->where('name','total_price_before_enable_sales')->delete();
            $ff= DB::table('accounting_settings')->where('name','unit_price_before_enable_sales')->delete();
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
