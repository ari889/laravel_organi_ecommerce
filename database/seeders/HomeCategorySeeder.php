<?php

namespace Database\Seeders;

use App\Models\HomeCategory;
use Illuminate\Database\Seeder;

class HomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomeCategory::create([
            'sel_categories' => '1,2,3,4,5,6,7',
            'no_of_products' => 12
        ]);
    }
}
