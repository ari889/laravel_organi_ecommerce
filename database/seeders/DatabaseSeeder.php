<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\HomeCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            SettingsSeeder::class,
            ProductSeeder::class,
            HomeCategory::class
        ]);
    }
}
