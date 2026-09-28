<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['nom' => 'Phones', 'description' => 'Latest smartphones and mobile devices.'],
            ['nom' => 'Laptops', 'description' => 'High performance laptops and notebooks.'],
            ['nom' => 'Tablets', 'description' => 'Versatile tablets for work and play.'],
            ['nom' => 'Accessories', 'description' => 'Premium tech accessories and wearables.']
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['nom' => $cat['nom']], $cat);
        }
    }
}
