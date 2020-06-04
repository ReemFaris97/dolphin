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
                    [ 'id' => '49', 'name' => 'إدارة الشركات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '50', 'name' => 'إدارة  الفروع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '51', 'name' => 'إدارة الخزائن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '52', 'name' => 'إدارة  الاجهزة', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '53', 'name' => 'إدارة الورديات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '54', 'name' => 'إدارة  المخازن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '55', 'name' => 'إدارة تصنيفات الاقسام', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '56', 'name' => 'إدارة  الضرائب', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '57', 'name' => 'إدارة المنتجات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '58', 'name' => 'إدارة  ارفف المنتجات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '59', 'name' => 'إدارة التقارير', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '60', 'name' => 'تقارير المشتريات ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '61', 'name' => 'تقارير المبيعات ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '62', 'name' => 'تقارير الموردين ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '63', 'name' => 'تقارير المخازن ', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '64', 'name' => ' الاعدادات العامة', 'ar_name' => '-', 'guard_name'=>'web'],



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
