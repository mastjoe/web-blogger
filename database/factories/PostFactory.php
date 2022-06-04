<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
            //
            'title'            => $this->faker->words(mt_rand(5,10), true),
            'slug'             => $this->faker->unique()->slug(),
            'description'      => $this->faker->realText(300),
            'user_id'          => User::factory(),
            'publication_date' => now()->subDays(rand(0, 60)),
        ];
    }
}
