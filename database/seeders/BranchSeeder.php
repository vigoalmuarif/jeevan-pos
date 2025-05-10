<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouses')->insert([
            'business_id' => 1,
            'warehouse_code' => 'GD001',
            'name' => 'Gudang Utama',
            'slug' => 'gudang-utama',
            'location' => '-',
            'type' => 'Warehouse',
            'address' => '-',
            'phone' => '-',
            'ppic_id' => 1,
            'status' => 1
        ]);
    }
}
