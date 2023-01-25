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
        $channel = ForumChannel::all()->random();
        $created_at = $this->faker->dateTimeBetween($channel->created_at, 'now');
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        return [
            'message' => $this->faker->paragraph,
            'channel_id' => $channel->id,
            'created_by' => User::all()->random()->id,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
