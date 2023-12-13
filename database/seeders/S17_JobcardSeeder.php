<?php

namespace Database\Seeders;

use App\Models\Erp\Production\Jobcard;
use App\Models\Erp\Production\JobcardItem;
use Illuminate\Database\Seeder;

class S17_JobcardSeeder extends Seeder
{
    public static function run(): void
    {
        $job = Jobcard::create([
            'vno' => '101',
            'vdate' => '2023-10-19',
            'order_id' => '1',
            'style_id' => '1',
            'total_qty' => 200,
            'active_id' => '1',
            'tenant_id' => '1',
            'user_id' => '1',
        ]);

        JobcardItem::create([
            'jobcard_id' => $job->id,
            'fabric_lot_id' => '1',
            'colour_id' => '1',
            'size_id' => '1',
            'qty' => 200,
            'cutting_qty' => '0',
            'pe_out_qty' => '0',
            'pe_in_qty' => '0',
            'se_out_qty' => '0',
            'se_in_qty' => '0',
            'active_id' => '1',
        ]);


        //
        // 102
        //

        $job = Jobcard::create([
            'vno' => '102',
            'vdate' => '2023-10-18',
            'order_id' => '2',
            'style_id' => '2',
            'total_qty' => 400,
            'active_id' => '1',
            'tenant_id' => '1',
            'user_id' => '1',
        ]);

        JobcardItem::create([
            'jobcard_id' => $job->id,
            'fabric_lot_id' => '2',
            'colour_id' => '2',
            'size_id' => '2',
            'qty' => 400,
            'cutting_qty' => '0',
            'pe_out_qty' => '0',
            'pe_in_qty' => '0',
            'se_out_qty' => '0',
            'se_in_qty' => '0',
            'active_id' => '1',
        ]);


        //
        // 103
        //

        $job = Jobcard::create([
            'vno' => '103',
            'vdate' => '2023-10-16',
            'order_id' => '3',
            'style_id' => '3',
            'total_qty' => 600,
            'active_id' => '1',
            'tenant_id' => '1',
            'user_id' => '1',
        ]);

        JobcardItem::create([
            'jobcard_id' => $job->id,
            'fabric_lot_id' => '3',
            'colour_id' => '3',
            'size_id' => '3',
            'qty' => 600,
            'cutting_qty' => '0',
            'pe_out_qty' => '0',
            'pe_in_qty' => '0',
            'se_out_qty' => '0',
            'se_in_qty' => '0',
            'active_id' => '1',
        ]);
    }
}
