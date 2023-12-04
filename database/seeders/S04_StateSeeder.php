<?php

namespace Database\Seeders;

use App\Models\Common\State;
use Illuminate\Database\Seeder;

class S04_StateSeeder extends Seeder
{
    public static function run(): void
    {
        State::create([
           'vname' => 'Tamilnadu',
           'state_code' => '33'
        ]);
    }
}
