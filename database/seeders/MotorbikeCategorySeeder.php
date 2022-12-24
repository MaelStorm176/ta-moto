<?php

namespace Database\Seeders;

use App\Models\MotorbikeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotorbikeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        MotorbikeCategory::factory()->count(10)->create();
    }
}
