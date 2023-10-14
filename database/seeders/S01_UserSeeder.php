<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class S01_UserSeeder extends Seeder
{
    public static function run(): void
    {
        User::create([
            'name' => 'sundar',
            'email' => 'sundar@sundar.com',
            'password' => bcrypt('kalarani'),
            'email_verified_at'=> now(),
            'active_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Adal',
            'email' => 'adal@aaran.com',
            'password' => bcrypt('123456789'),
            'email_verified_at'=> now(),
            'active_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Karthi',
            'email' => 'karthi@aaran.com',
            'password' => bcrypt('123456789'),
            'email_verified_at'=> now(),
            'active_id' => '1',
            'remember_token' => Str::random(10)
        ]);


        User::create([
            'name' => 'MD',
            'email' => 'md@amaltex.in',
            'password' => bcrypt('123456789'),
            'email_verified_at'=> now(),
            'active_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Arun',
            'email' => 'arun@amaltex.in',
            'password' => bcrypt('123456789'),
            'email_verified_at'=> now(),
            'active_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'mohan',
            'email' => 'mohan@amaltex.in',
            'password' => bcrypt('123456789'),
            'email_verified_at'=> now(),
            'active_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Nithyan',
            'email' => 'Nithyan@amaltex.in',
            'password' => bcrypt('123456789'),
            'email_verified_at'=> now(),
            'active_id' => '1',
            'remember_token' => Str::random(10)
        ]);
    }
}
