<?php

namespace Database\Seeders;

use App\Models\Master\ClientDetail;
use Illuminate\Database\Seeder;

class S02_ClientDetailSeeder extends Seeder
{
    public static function run(): void
    {
        ClientDetail::create([
            'client_id' => '1',
            'vname' => 'SUNDAR',
            'mobile' => '9655227738',
            'whatsapp' => '9655227767',
            'email' => 'sundar@sundar.com',
            'gstin' => '33ACAFA1184B1Z6',

            'address_1' => '10/20, PUGALUMPERUMAL STREET',
            'address_2' => 'KUMARANTHAPURAM EAST EXTN 1 STREET',
            'city' => 'Tirupur',
            'state' => 'TAMILNADU',
            'pincode' => '641602',

            'gst_user' => 'gst_user',
            'gst_pass' => 'gst_pass',

            'einvoice_user' => 'einvoice_user',
            'einvoice_pass' => 'einvoice_pass',

            'eway_user' => 'eway_user',
            'eway_pass' => 'eway_pass',

            'einvoice_api' => 'einvoice_api',
            'einvoice_api_pass' => 'einvoice_api_pass',

            'eway_api' => 'eway_api',
            'eway_api_pass' => 'eway_api_pass',

            'acc_email' => 'acc_email',
            'acc_email_pass' => 'acc_email_pass',
        ]);
    }
}
