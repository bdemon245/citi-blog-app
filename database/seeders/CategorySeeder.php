<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Health", "Technology", "Personal Finance", "Finance", "Lifestyle"
        ];
        foreach ($categories as $value) {
            Category::create([
                'title' => $value,
                'slug' => str()->slug($value),
            ]);
        }
    }
}
