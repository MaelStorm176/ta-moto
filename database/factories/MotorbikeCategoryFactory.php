<?php

namespace Database\Factories;

use App\Models\MotorbikeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MotorbikeCategory>
 */
class MotorbikeCategoryFactory extends Factory
{
    protected $model = MotorbikeCategory::class;
    protected array $categoryFakeName = [
        "sport",
        "touring",
        "cruiser",
        "chopper",
        "naked",
        "adventure",
        "dual-sport",
        "supermoto",
        "enduro",
        "scooter",
        "custom",
        "dirt",
        "streetfighter",
        "atv",
        "utv",
        "snowmobile",
        "trike",
        "quad",
        "pocketbike",
        "minibike",
        "chopper",
        "cruiser",
        "dirtbike",
        "dual-sport",
        "moped",
        "motocross",
    ];
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement($this->categoryFakeName),
            'created_at' => now(),
            'updated_at' => now(),
            'banner_img' => fake()->imageUrl(),
            'slug' => fake()->slug(2),
        ];
    }
}
