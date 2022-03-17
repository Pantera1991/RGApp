<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $ids = Post::pluck('id')->toArray();

        return [
            'author' => $this->faker->name,
            'content' => $this->faker->sentence(random_int(5, 20)),
            'post_id' => $this->faker->randomElement($ids)
        ];
    }
}
