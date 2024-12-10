<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = ['Electronics', 'Clothing', 'Gym', 'Beauty', 'Home & Kitchen'];

        for ($i = 1; $i <= 10; $i++) {
            product::create([
                'name' => fake()->name(),
                'image' => fake()->imageUrl('products'),
                'price' => fake()->randomFloat(2,10,5000),
                'category' => fake()->randomElement($categories),
                'quantity' => fake()->numberBetween(1, 600),
                'stock' => fake()->numberBetween(0, 700),
            ]);
        }
    }
}
