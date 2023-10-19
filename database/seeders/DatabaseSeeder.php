<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        S01_UserSeeder::run();
        S02_TenantSeeder::run();
        S03_CitySeeder::run();

        S09_ColourSeeder::run();
        S10_SizeSeeder::run();
//        S12_ContactSeeder::run();
//        S14_OrderSeeder::run();
//        S15_StyleSeeder::run();
//        S16_FabricLotSeeder::run();
//        S17_JobcardSeeder::run();
    }
}
