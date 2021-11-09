<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        \DB::table('model_has_permissions')->delete();

        \DB::table('model_has_permissions')->insert(array (
            0 =>
            array (
                'permission_id' => 1,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            1 =>
            array (
                'permission_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            2 =>
            array (
                'permission_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            3 =>
            array (
                'permission_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            4 =>
            array (
                'permission_id' => 5,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            5 =>
            array (
                'permission_id' => 6,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            6 =>
            array (
                'permission_id' => 7,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            7 =>
            array (
                'permission_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            8 =>
            array (
                'permission_id' => 9,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            9 =>
            array (
                'permission_id' => 10,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            10 =>
            array (
                'permission_id' => 11,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            11 =>
            array (
                'permission_id' => 12,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            12 =>
            array (
                'permission_id' => 13,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            13 =>
            array (
                'permission_id' => 14,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            14 =>
            array (
                'permission_id' => 15,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            15 =>
            array (
                'permission_id' => 16,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            16 =>
            array (
                'permission_id' => 17,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            17 =>
            array (
                'permission_id' => 18,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            18 =>
            array (
                'permission_id' => 19,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            19 =>
            array (
                'permission_id' => 20,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            20 =>
            array (
                'permission_id' => 21,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            21 =>
            array (
                'permission_id' => 22,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            22 =>
            array (
                'permission_id' => 24,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            23 =>
            array (
                'permission_id' => 25,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            24 =>
            array (
                'permission_id' => 26,
                'model_type' => 'App\\User',
                'model_id' => 51,
            ),
            25 =>
            array (
                'permission_id' => 1,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            26 =>
            array (
                'permission_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            27 =>
            array (
                'permission_id' => 5,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            28 =>
            array (
                'permission_id' => 6,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            29 =>
            array (
                'permission_id' => 7,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            30 =>
            array (
                'permission_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            31 =>
            array (
                'permission_id' => 10,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            32 =>
            array (
                'permission_id' => 15,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            33 =>
            array (
                'permission_id' => 16,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            34 =>
            array (
                'permission_id' => 18,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            35 =>
            array (
                'permission_id' => 19,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            36 =>
            array (
                'permission_id' => 21,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            37 =>
            array (
                'permission_id' => 22,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            38 =>
            array (
                'permission_id' => 25,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
            39 =>
            array (
                'permission_id' => 26,
                'model_type' => 'App\\User',
                'model_id' => 24,
            ),
        ));
        // $this->call(AccountingAccountsTableSeeder::class);
    }
}
