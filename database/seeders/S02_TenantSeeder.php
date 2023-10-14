<?php

namespace Database\Seeders;

use App\Models\tenant;
use Illuminate\Database\Seeder;

class S02_TenantSeeder extends Seeder
{
    public static function run(): void
    {
        tenant::create([
            'vname' => 'codexsun',
            'active_id' => '1'
        ]);
    }
}
