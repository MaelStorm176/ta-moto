<?php

namespace Database\Seeders;

use App\Models\ForumChannel;
use App\Models\ForumChannelMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ForumChannel::factory()->count(50)->create();
        ForumChannelMessage::factory()->count(1500)->create();
    }
}
