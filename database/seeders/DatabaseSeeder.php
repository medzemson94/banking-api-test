<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'user@admin.com',
            'password' => Hash::make('123456789'),
            'phone' => '00237690048395',
            'is_enable'=>true,
             'role' =>'admin',
             'avatar'=>''
        ]);
    }
}
