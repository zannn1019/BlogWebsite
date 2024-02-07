<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake('en')->unique()->paragraph(1);
        return [
            'id' => Str::uuid(),
            'title' => $title,
            'content' => fake('en')->paragraph(random_int(5, 20)),
            'slug' => Str::slug($title),
            'thumbnail' => null,
            'category_id' => Categories::all()->random(1)->value('id')
        ];
    }
}
