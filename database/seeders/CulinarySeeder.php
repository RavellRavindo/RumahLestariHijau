<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CulinarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('culinaries')->insert([
            [
                'id'=> 1,
                'name' => "Ikan Goreng",
                'type' => "side_dish",
                'description' => "Ikan Goreng rasa ikannya enak",
                'rating' => 5,
                'price' => 40000,
                'photo' => "culinary_img/IkanGoreng_Seeder.jpg",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id'=> 2,
                'name' => "Sop Buntut",
                'type' => "main_course",
                'description' => "Sop buntut rasa sopnya enak",
                'rating' => 4.9,
                'price' => 50000,
                'photo' => "culinary_img/SopBuntut_Seeder.jpg",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id'=> 3,
                'name' => "Ayam Goreng",
                'type' => "side_dish",
                'description' => "Ayam Goreng rasa ayamnya enak",
                'rating' => 4.8,
                'price' => 20000,
                'photo' => "culinary_img/AyamGoreng_Seeder.jpeg",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
