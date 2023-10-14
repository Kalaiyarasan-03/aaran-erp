<?php

namespace Database\Seeders;

use App\Models\Erp\Order;
use Illuminate\Database\Seeder;

class S14_OrderSeeder extends Seeder
{
    public static function run(): void
    {
        Order::create([
            'vname' => 'SK-001',
            'desc' => 'SK-001 desc',
            'active_id' => '1',
            'user_id' => '1'
        ]);

        Order::create([
            'vname' => 'SK-002',
            'desc' => 'SK-002 desc',
            'active_id' => '1',
            'user_id' => '1'
        ]);

        Order::create([
            'vname' => 'SK-003',
            'desc' => 'SK-003 desc',
            'active_id' => '1',
            'user_id' => '1'
        ]);
    }
}
