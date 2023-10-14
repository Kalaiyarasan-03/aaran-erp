<?php

namespace Database\Seeders;

use App\Models\Common\Colour;
use Illuminate\Database\Seeder;

class S09_ColourSeeder extends Seeder
{
    public static function run(): void
    {
        Colour::create([
            'vname' => 'Red',
            'active_id' => '1'
        ]);

        Colour::create([
            'vname' => 'Green',
            'active_id' => '1'
        ]);

        Colour::create([
            'vname' => 'Orange',
            'active_id' => '1'
        ]);

        Colour::create([
            'vname' => 'Blue',
            'active_id' => '1'
        ]);
    }
}
