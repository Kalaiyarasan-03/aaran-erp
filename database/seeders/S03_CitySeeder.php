<?php

namespace Database\Seeders;

use App\Models\Common\City;
use Illuminate\Database\Seeder;

class S03_CitySeeder extends Seeder
{
    public  static function run(): void
    {
       City::create([
           'vname' => 'Tiruppur',
           'active_id' => '1'
       ]);
    }
}
