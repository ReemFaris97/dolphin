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
                    [ 'id' => '1', 'name' => 'عرض الشركات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '2', 'name' => 'اضافة الشركه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '3', 'name' => 'تعديل الشركه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '4', 'name' => 'حذف الشركه', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '5', 'name' => 'عرض  الفروع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '6', 'name' => 'اضافة الفرع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '7', 'name' => 'تعديل الفرع', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '8', 'name' => 'حذف الفرع', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '9', 'name' => 'عرض  الخزائن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '10', 'name' => 'اضافة خزينه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '11', 'name' => 'تعديل الخزينة', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '12', 'name' => 'حذف الخزينة', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '13', 'name' => 'عرض  الاجهزه', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '14', 'name' => 'اضافة جهاز', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '15', 'name' => 'تعديل الجهاز', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '16', 'name' => 'حذف الجهاز', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '17', 'name' => 'عرض  المخازن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '18', 'name' => 'اضافة مخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '19', 'name' => 'تعديل المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '20', 'name' => 'حذف المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '45', 'name' => 'تحويلات الاصناف فى المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '46', 'name' => 'جرد المخزن', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '47', 'name' => 'اصناف تالفة', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '48', 'name' => 'سندات المخازن', 'ar_name' => '-', 'guard_name'=>'web'],


                    [ 'id' => '22', 'name' => 'عرض  العملاء', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '23', 'name' => 'اضافة عميل', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '24', 'name' => 'تعديل العميل', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '25', 'name' => 'حذف العميل', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '26', 'name' => 'عرض الجلسات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '27', 'name' => 'الجلسات المغلقة من الكاشير', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '28', 'name' => 'عرض فواتير المبيعات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '29', 'name' => 'عرض فواتير مرتجعات المبيعات', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '30', 'name' => 'عرض فواتير المشتريات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '31', 'name' => 'اضافة فاتورة مشتريات', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '32', 'name' => 'عرض فواتير مرتجعات المشتريات', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '33', 'name' => 'اضافة فاتورة مرتجع مشترى', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '34', 'name' => 'عرض الموردين', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '35', 'name' => 'اضافة مورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '36', 'name' => 'تعديل مورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '37', 'name' => 'حذف المورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '38', 'name' => 'سجل سداد مورد', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '39', 'name' => 'اضافة مشتريات مورد', 'ar_name' => '-', 'guard_name'=>'web'],

                    [ 'id' => '40', 'name' => 'عرض سندات القبض والصرف', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '41', 'name' => 'اضافة سند', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '42', 'name' => 'تعديل السند', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '43', 'name' => 'حذف السند', 'ar_name' => '-', 'guard_name'=>'web'],
                    [ 'id' => '44', 'name' => 'نقطة البيع', 'ar_name' => '-', 'guard_name'=>'web'],

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
