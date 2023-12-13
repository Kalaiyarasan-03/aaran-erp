<?php

namespace Database\Seeders;

use App\Models\Erp\Style;
use Illuminate\Database\Seeder;

class S15_StyleSeeder extends Seeder
{
    public static function run(): void
    {
        Style::create([
            'vname' => 'Style - 1',
            'desc' => 'Style - 1 desc',
            'active_id' => '1',
            'tenant_id' => '1',
            'user_id' => '1'
        ]);

        Style::create([
            'vname' => 'Style - 2',
            'desc' => 'Style - 2 desc',
            'active_id' => '1',
            'tenant_id' => '1',
            'user_id' => '1'
        ]);

        Style::create([
            'vname' => 'Style - 3',
            'desc' => 'Style - 3 desc',
            'active_id' => '1',
            'tenant_id' => '1',
            'user_id' => '1'
        ]);
    }
}
