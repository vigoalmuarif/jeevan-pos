<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Cahyo Vigo Al Mu Arif',
            'birthday' => '1997-08-30',
            'username' => 'vigoalmuarif',
            'phone' => '081393991566',
            'email' => 'vigoalmuarif@example.com',
            'gender' => 'L',
            'employee_position_id' => null,
            'employee_code' => 'A0001',
            'password' => Hash::make('password'),
        ]);
    }
}
