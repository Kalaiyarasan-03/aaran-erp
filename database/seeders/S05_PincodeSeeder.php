<?php

namespace Database\Seeders;

use App\Models\Common\Pincode;
use Illuminate\Database\Seeder;

class S05_PincodeSeeder extends Seeder
{
    public static function run(): void
    {
        Pincode::create([
            'vname' => '641601'
        ]);

        Pincode::create([
            'vname' => '641602'
        ]);

        Pincode::create([
            'vname' => '641603'
        ]);

        Pincode::create([
            'vname' => '641604'
        ]);

    }
}
