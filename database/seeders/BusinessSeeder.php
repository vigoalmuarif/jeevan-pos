<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('businesses')->insert([
            'owner_id' => 1,
            'business_type' => 'Outlet',
            'business_name' => 'Omset',
            'address' => 'Jl. keluar',
            'status' => 1
        ]);
    }
}
