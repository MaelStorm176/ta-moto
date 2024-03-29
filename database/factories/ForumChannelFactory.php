<?php

namespace Database\Factories;

use App\Models\ForumChannel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ForumChannel>
 */
class ForumChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', 'now');
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        return [
            'title' => substr($this->faker->sentence, 0, 50),
            'max_users' => $this->faker->numberBetween(1, 100),
            'created_by' => User::where('role_id', 1)->get()->random()->id,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
