<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ide;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserIdeaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'idea_id' => Ide::inRandomOrder()->first()->id ?? Ide::factory(),
            'is_favorited' => fake()->boolean(),
        ];
    }
}
