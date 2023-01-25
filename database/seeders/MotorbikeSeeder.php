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
        $categories = MotorbikeCategory::all();
        Motorbike::factory()->count(30)->create()->each(function ($motorbike) use ($categories) {
            $motorbike->category()->associate($categories->random());
            $motorbike->save();
        });
    }
}
