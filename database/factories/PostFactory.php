<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $paragraphs = $this->faker->paragraphs(random_int(2, 6));

        $content = "";
        foreach ($paragraphs as $para) {
            $content .= "<p>{$para}</p>";
        }

        return [
            'title' =>  $this->faker->sentence(5),
            'content' => $content,
            'author' => $this->faker->name
        ];
    }
}
