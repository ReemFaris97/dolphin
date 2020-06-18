<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermesionsPart2ToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::table('permissions')->insert(
                array(
                    [ 'id' => '88', 'name' => 'إدارة الشركات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '90', 'name' => 'إدارة  الفروع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '91', 'name' => 'إدارة الخزائن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '92', 'name' => 'إدارة  الاجهزة', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '93', 'name' => 'إدارة الورديات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '94', 'name' => 'إدارة  المخازن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '95', 'name' => 'إدارة تصنيفات الاقسام', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '96', 'name' => 'إدارة  الضرائب', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '97', 'name' => 'إدارة المنتجات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '98', 'name' => 'إدارة  ارفف المنتجات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '99', 'name' => 'إدارة التقارير', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '100', 'name' => 'تقارير المشتريات ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '101', 'name' => 'تقارير المبيعات ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '102', 'name' => 'تقارير الموردين ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '103', 'name' => 'تقارير المخازن ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '104', 'name' => ' الاعدادات العامة', 'ar_name' => '-', 'guard_name'=>'web'],



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
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
}
