<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\MakeSlug;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    use MakeSlug;
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
                    "slug" => $this->makeSlug("sub_categories", $value),
                ]);
            }
        }
    }
}
