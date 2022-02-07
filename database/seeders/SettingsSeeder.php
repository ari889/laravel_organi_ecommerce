<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name' => 'email',
            'value' => 'arijitbanarjee889@gmail.com'
        ]);

        Settings::create([
            'name' => 'phone',
            'value' => '+8801733163337'
        ]);

        Settings::create([
            'name' => 'address',
            'value' => 'Mohadevpur, Naogaon'
        ]);

        Settings::create([
            'name' => 'footer_text',
            'value' => 'Copyright ©2022 All rights reserved | This template is made with by Arijit'
        ]);

        Settings::create([
            'name' => 'facebook',
            'value' => 'https://facebook.com/arijit.pranto/'
        ]);

        Settings::create([
            'name' => 'twitter',
            'value' => '#'
        ]);

        Settings::create([
            'name' => 'instagram',
            'value' => '#'
        ]);

        Settings::create([
            'name' => 'pinterest',
            'value' => '#'
        ]);


    }
}
