<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermesionsToPermissionsTable extends Migration
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
                    [ 'id' => '40', 'name' => 'عرض الشركات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '41', 'name' => 'اضافة الشركه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '42', 'name' => 'تعديل الشركه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '43', 'name' => 'حذف الشركه', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '45', 'name' => 'عرض  الفروع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '46', 'name' => 'اضافة الفرع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '47', 'name' => 'تعديل الفرع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '48', 'name' => 'حذف الفرع', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '49', 'name' => 'عرض  الخزائن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '50', 'name' => 'اضافة خزينه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '51', 'name' => 'تعديل الخزينة', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '52', 'name' => 'حذف الخزينة', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '53', 'name' => 'عرض  الاجهزه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '54', 'name' => 'اضافة جهاز', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '55', 'name' => 'تعديل الجهاز', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '56', 'name' => 'حذف الجهاز', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '57', 'name' => 'عرض  المخازن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '58', 'name' => 'اضافة مخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '59', 'name' => 'تعديل المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '60', 'name' => 'حذف المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '61', 'name' => 'تحويلات الاصناف فى المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '62', 'name' => 'جرد المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '63', 'name' => 'اصناف تالفة', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '64', 'name' => 'سندات المخازن', 'ar_name' => '-', 'guard_name'=>'web'],


                    [ 'id' => '65', 'name' => 'عرض  العملاء', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '66', 'name' => 'اضافة عميل', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '67', 'name' => 'تعديل العميل', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '68', 'name' => 'حذف العميل', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '69', 'name' => 'عرض الجلسات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '70', 'name' => 'الجلسات المغلقة من الكاشير', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '71', 'name' => 'عرض فواتير المبيعات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '72', 'name' => 'عرض فواتير مرتجعات المبيعات', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '73', 'name' => 'عرض فواتير المشتريات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '74', 'name' => 'اضافة فاتورة مشتريات', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '75', 'name' => 'عرض فواتير مرتجعات المشتريات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '76', 'name' => 'اضافة فاتورة مرتجع مشترى', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '77', 'name' => 'عرض الموردين', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '78', 'name' => 'اضافة مورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '79', 'name' => 'تعديل مورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '80', 'name' => 'حذف المورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '81', 'name' => 'سجل سداد مورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '82', 'name' => 'اضافة مشتريات مورد', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '83', 'name' => 'عرض سندات القبض والصرف', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '84', 'name' => 'اضافة سند', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '85', 'name' => 'تعديل السند', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '86', 'name' => 'حذف السند', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '87', 'name' => 'نقطة البيع', 'ar_name' => '-', 'guard_name'=>'web'],

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
