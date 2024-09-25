<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Musician>
 */
class MusicianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'profile_picture'=>fake()->imageUrl(),
            'birth_date'=>fake()->date(),
            'instrument'=>fake()->text(),
            'biography'=>fake()->text(),
        ];
    }
}
