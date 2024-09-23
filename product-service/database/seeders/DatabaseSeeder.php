<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Category::factory(10)->create()->each(function ($category) {
            $category->products()->saveMany(Product::factory(10)->make());
        });
    }
}
