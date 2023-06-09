<?php

namespace Database\Factories;

use App\Traits\MakeSlug;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    use MakeSlug;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(40);
        $seed = substr($title, 0, 5);
        $map = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
            [10, 11, 12],
            [13, 14, 15, 16],
        ];



        [$categoryId, $subId] = $this->getIds($map);

        return [
            "title" => $title,
            "slug" => $this->makeSlug("posts", $title),
            "content" => fake()->realText(500),
            "user_id" => fake()->randomElement([1, 2, 3, 4, 5, 6]),
            "category_id" => $categoryId,
            "sub_category_id" => $subId,
            "is_banner" => 0,
            "featured_img" => "https://picsum.photos/seed/$seed/720/480",
        ];
    }

    public function getIds($map)
    {
        $key = fake()->randomElement([0, 1, 2, 3, 4]);
        $subId = fake()->randomElement($map[$key]);

        $categoryId = $key + 1;

        return [$categoryId, $subId];
    }
}
