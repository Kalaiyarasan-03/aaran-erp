<?php

namespace Database\Seeders;

use App\Models\Master\Contact;
use Illuminate\Database\Seeder;

class S12_ContactSeeder extends Seeder
{
      public static function run(): void
    {
        Contact::create([
            'vname' => 'sundar company',
            'contact_person' => 'sundar',
            'mobile' => '9655227738',
            'whatsapp' => '9655228877',
            'landline' => '0421-2456251',
            'gstin' => '33AARRSS',
            'pan' => 'pan',
            'email' => 'email',
            'website' => 'website',
            'address_street' => 'street',
            'address_area' => 'area',
            'city_id' => '1',
            'state_id' => '1',
            'pincode_id' => '1',
            'active_id' => '1',
            'user_id' => '1'
        ]);

        Contact::create([
            'vname' => 'new company',
            'contact_person' => 'sundar',
            'mobile' => '9655227738',
            'whatsapp' => '9655228877',
            'landline' => '0421-2456251',
            'gstin' => '33AARRSS',
            'pan' => 'pan',
            'email' => 'email',
            'website' => 'website',
            'address_street' => 'street',
            'address_area' => 'area',
            'city_id' => '1',
            'state_id' => '1',
            'pincode_id' => '1',
            'active_id' => '1',
            'user_id' => '1'
        ]);
    }
}
