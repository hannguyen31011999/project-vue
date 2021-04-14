<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bds_user')->insert([
            [
                'id_role'=>1,
                'email'=>'hannguyen3111999@gmail.com',
                'password'=>Hash::make('123'),
                'fullname'=>'Nguyễn Việt Hân',
                'birth_date'=>null,
                'gender'=>0,
                'address'=>'50 đường 144,phường Tân Phú, TP Thủ Đức',
                'cmnd'=>'025925025',
                'phone'=>'0382484093',
                'remember_token'=>null
            ],
            [
                'id_role'=>1,
                'email'=>'xethongs100@gmail.com',
                'password'=>Hash::make('123'),
                'fullname'=>'Nguyễn Việt Anh',
                'birth_date'=>null,
                'gender'=>0,
                'address'=>'50 đường 144,phường Tân Phú, TP Thủ Đức',
                'cmnd'=>'024924024',
                'phone'=>'0377797722',
                'remember_token'=>null
            ]
        ]);
    }
}
