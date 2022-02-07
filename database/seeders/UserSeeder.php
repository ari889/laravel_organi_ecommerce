<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Arijit Banarjee',
            'email_verified_at' => Carbon::now(),
            'email' => 'arijitbanarjee889@gmail.com',
            'password' => 'asdfg1234',
            'utype' => 'SUPADM'
        ]);
    }
}
