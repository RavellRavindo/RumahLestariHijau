<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        DB::table('users')->insert([
           'name' => "Admin",
           'email' => 'admin@admin.com',
           'password' => Hash::make('12345678'),
           'isAdmin' => 1,
        ]);

        DB::table('users')->insert([
            'name' => "User",
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
            'isAdmin' => 0,
         ]);

        //\App\Models\User::factory(10)->create();

    }
}