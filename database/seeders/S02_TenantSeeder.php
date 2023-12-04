<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class S02_TenantSeeder extends Seeder
{
    public static function run(): void
    {
        Tenant::create([
            'vname' => 'codexsun',
            'active_id' => '1'
        ]);
    }
}
