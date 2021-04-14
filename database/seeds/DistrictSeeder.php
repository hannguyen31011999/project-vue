<?php

use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bds_district')->insert([
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 1"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 2"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 3"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 4"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 5"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 6"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 7"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 8"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 9"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 10"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 11"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận 12"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận Thủ Đức"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận Gò Vấp"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận Bình Thạnh"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận Tân Bình"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận Tân Phú"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận Phú Nhuận"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Quận Bình Tân"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Huyện Củ Chi"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Huyện Hóc Môn"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Huyện Bình Chánh"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Huyện Nhà Bè"
        	],
        	[
        		'province_id'=>1,
        		'district_name'=> "Huyện Cần Giờ"
        	],
        ]);
    }
}
