<?php

namespace Database\Seeders;

use App\Models\Common\Size;
use Illuminate\Database\Seeder;

class S10_SizeSeeder extends Seeder
{

    public static function run(): void
    {
        Size::create([
            'vname' => 'S',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'M',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'L',
            'active_id' => '1'
        ]);

        Size::create([
            'vname' => 'XL',
            'active_id' => '1'
        ]);
    }
}
