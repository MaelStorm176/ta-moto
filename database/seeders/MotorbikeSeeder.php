<?php

namespace Database\Seeders;

use App\Models\Motorbike;
use App\Models\MotorbikeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotorbikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Motorbike::factory()->count(30)->create();
    }
}
