<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Traits\MakeSlug;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use MakeSlug;
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
                'slug' => $this->makeSlug('categories', $value),
            ]);
        }
    }
}
