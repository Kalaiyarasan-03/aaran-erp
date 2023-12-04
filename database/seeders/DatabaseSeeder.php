<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        S01_UserSeeder::run();
        S02_TenantSeeder::run();
        S03_CitySeeder::run();
        S04_StateSeeder::run();
        S05_PincodeSeeder::run();

        S09_ColourSeeder::run();
        S10_SizeSeeder::run();
//        S12_ContactSeeder::run();
//        S14_OrderSeeder::run();
//        S15_StyleSeeder::run();
//        S16_FabricLotSeeder::run();
//        S17_JobcardSeeder::run();
    }
}
