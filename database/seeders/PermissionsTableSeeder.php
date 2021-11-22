<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'assign_task',
                'ar_name' => 'إسناد المهمات',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'finish_assigned_task',
                'ar_name' => 'إنهاء المهمة المسندة',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'rate_assigned_task',
                'ar_name' => 'تقييم المهمة بعد إسنادها',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'replace_tasks',
                'ar_name' => 'استبدال المهام بين موظف و آخر',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'view_charges',
                'ar_name' => 'عرض العهد الموجودة',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'assign_charges',
                'ar_name' => 'إسناد العهد إلى الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'edit_charges',
                'ar_name' => 'تعديل العهد',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'destroy_charges',
                'ar_name' => 'إتلاف العهد',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'view_assigned_charges',
                'ar_name' => 'عرض العهد مع الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'view_workers_reports',
                'ar_name' => 'عرض تقارير الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'insert_numbers',
                'ar_name' => 'إدخال الأرقام',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'view_workers',
                'ar_name' => 'عرض الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'add_workers',
                'ar_name' => 'إضافة الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'edit_workers',
                'ar_name' => 'تعديل بيانات الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'delete_workers',
                'ar_name' => 'حذف الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'view_tasks',
                'ar_name' => 'عرض المهام',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'add_tasks',
                'ar_name' => 'إضافة المهام',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'delete_tasks',
                'ar_name' => 'حذف المهام',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'edit_tasks',
                'ar_name' => 'تعديل المهام',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'view_charges',
                'ar_name' => 'عرض العهد',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'add_charges',
                'ar_name' => 'إضافة العهد',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'delete_charges',
                'ar_name' => 'حذف العهد',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 24,
                'name' => 'view_emp_chat',
                'ar_name' => 'عرض الدردشة بين الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 25,
                'name' => 'view_emp_notifications',
                'ar_name' => 'عرض إشعارات الموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 26,
                'name' => 'send_emp_notifications',
                'ar_name' => 'إرسال إشعارات للموظفين',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
