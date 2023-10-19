<?php

namespace Database\Seeders;

use App\Models\Erp\Fabrication\FabricLot;
use Illuminate\Database\Seeder;

class S16_FabricLotSeeder extends Seeder
{
    public static function run(): void
    {
        FabricLot::create([
            'vname' => 'Lot- 1',
            'desc' => 'Lot - 1 desc',
            'active_id' => '1',
            'user_id' => '1'
        ]);

        FabricLot::create([
            'vname' => 'Lot- 2',
            'desc' => 'Lot -2 desc',
            'active_id' => '1',
            'user_id' => '1'
        ]);

        FabricLot::create([
            'vname' => 'Lot- 3',
            'desc' => 'Lot - 3 desc',
            'active_id' => '1',
            'user_id' => '1'
        ]);
    }
}
