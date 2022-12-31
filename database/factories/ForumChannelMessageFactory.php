<?php

namespace Database\Factories;

use App\Models\ForumChannel;
use App\Models\ForumChannelMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ForumChannelMessage>
 */
class ForumChannelMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message' => $this->faker->paragraph,
            'channel_id' => ForumChannel::all()->random()->id,
            'created_by' => User::all()->random()->id,
            'created_at' => $this->faker->dateTimeBetween('-1 year'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
