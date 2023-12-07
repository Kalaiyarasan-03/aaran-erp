<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class S06_TenantSeeder extends Seeder
{
    public static function run(): void
    {
        Tenant::create([
            'vname' => 'codexsun',
            'display_name' => 'codexsun',
            'address_1' => 'address_1',
            'address_2' => 'address_2',
            'city_id' => '1',
            'state_id' => '1',
            'pincode_id' => '1',
            'mobile' => '9655227738',
            'whatsapp' => '9655227767',
            'landline' => '0421-123456',
            'gstin' => '33AA12345689AA',
            'pan' => '123456789',
            'email' => 'admin@codexsun.com',
            'website' => 'codexsun.com',
            'active_id' => '1'
        ]);
    }
}
