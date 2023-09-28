<?php

namespace Database\Seeders;

use App\Models\Master\Client;
use Illuminate\Database\Seeder;

class S01_ClientSeeder extends Seeder
{
    public static function run(): void
    {
         Client::create([
             'vname' => 'AARAN ASSOCIATES',
             'group' => 'SUNDAR',
             'payable' => '1',
             'user_id' => '1',
             'active_id' => '1',
         ]);
    }
}
