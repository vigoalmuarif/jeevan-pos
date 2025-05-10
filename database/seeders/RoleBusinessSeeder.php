<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_role_business')->insert([
            'user_id' => 1,
            'business_id' => 1,
            'branch_id' => 1,
            'role_id' => 1,
            'is_head_office' => 1,
            'status' => 1
        ]);
    }
}
