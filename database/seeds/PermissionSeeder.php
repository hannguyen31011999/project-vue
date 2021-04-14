<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bds_role_permission')->insert([
            [
                'role_name'=>'admin',
                'permission'=>1
            ],
            [
                'role_name'=>'user',
                'permission'=>2
            ]
        ]);
    }
}
