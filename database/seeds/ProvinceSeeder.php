<?php

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bds_province')->insert([
            ['province_name'=>'Hồ Chí Minh']
        ]);
    }
}
