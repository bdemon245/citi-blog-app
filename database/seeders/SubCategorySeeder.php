<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategoryMap = [
            [
                "Nutrition",
                "Fitness",
                "Mental Health"
            ],
            [
                "Gadgets",
                "Software",
                "Internet"
            ],
            [
                "Destinations",
                "Accommodation",
                "Activities"
            ],
            [
                "Budgeting",
                "Investing",
                "Earning"
            ],
            [
                "Fashion",
                "Beauty",
                "Home & Decor",
                "Relationships"
            ],
        ];

        foreach ($subCategoryMap as $key => $values) {
            $key++;
            foreach ($values as $value) {
                SubCategory::updateOrCreate(['title' => $value], [
                    "category_id" => $key,
                    "title" => $value,
                    "slug" => str()->slug($value),
                ]);
            }
        }
    }
}
