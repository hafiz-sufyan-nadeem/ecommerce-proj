<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = ['Electronics', 'Clothing', 'Gym', 'Beauty', 'Home & Kitchen','fashion'];

        for ($i = 1; $i <= 10; $i++) {
            Category::create([
                'name' => fake()->randomElement($categories),
                'description' => fake()->randomElement(['Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.']),
            ]);
        }
    }
}
