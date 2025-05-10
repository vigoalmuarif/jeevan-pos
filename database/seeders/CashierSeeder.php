<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cashiers')->insert([
            'business_id' => 1,
            'warehouse_id' => 1,
            'user_id' => 1,
            'pin' => null,
            'status' => 1
        ]);
    }
}
