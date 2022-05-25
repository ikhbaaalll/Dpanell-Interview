<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $getTime = now()->setTimezone('Asia/Jakarta');

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->words(rand(1, 10), true),
            'start_at' => $getTime->addMinutes(rand(1, 200))->toDateTimeString(),
            'end_at' => $getTime->addMinutes(rand(200, 500))->toDateTimeString(),
            'status' => rand(0, 1)
        ];
    }
}
