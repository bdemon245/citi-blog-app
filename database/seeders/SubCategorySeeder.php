<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            'category_id' => 1,
            'title' => "Default Sub Category",
            'slug' => 'default-sub-cetegory',
        ]);
    }
}
