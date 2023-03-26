<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create 5 post where is banner is active
        Post::factory(5)->create([
            "is_banner" => 1
        ]);

        Post::factory(45)->create();
    }
}
