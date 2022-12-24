<?php

namespace Database\Factories;

use App\Models\Motorbike;
use Illuminate\Database\Eloquent\Factories\Factory;


class MotorbikeFactory extends Factory
{
    protected $model = Motorbike::class;
    protected array $motorbikeFakeName = [
        'Nightsky',
        'Sunset',
        'Sunrise',
        'Twilight',
        'Nightster',
        'Sportster',
        'Iron',
        'Forty-Eight',
        'Superlow',
        'Low Rider',
        'Low Rider S',
        'Street Bob',
        'Street Bob Special',
        'Street Glide',
        'Street Glide Special',
        'Road Glide',
        'Road Glide Special',
        'Alpha One',
        'Guardian',
        'CVO Limited',
        'CVO Street Glide',
        'CVO Road Glide',
        'CVO Road Glide Ultra',
        'CVO Road Glide Ultra Limited',
        'CVO Road Glide Ultra Limited Anniversary',
        'American Harley-Davidson',
        'American Iron',
        'American Iron 883',
        'American Iron 1200',
        'Indian Pale Ale',
        'French Connection',
        'French Connection 883',
    ];
    public function definition(): array
    {
        $path = storage_path('app/public/motorbikes/November2022');
        // read directory of images
        $images = scandir($path);
        // remove . and .. from array
        $images = array_diff($images, ['.', '..']);
        // select random image
        $image = $images[array_rand($images)];

        return [
            'name' => $this->faker->randomElement($this->motorbikeFakeName),
            'category_id' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 1000, 10000),
            'fuel' => $this->faker->randomElement(['petrol', 'diesel', 'electric']),
            'cylinder' => $this->faker->numberBetween(50, 200),
            'description' => $this->faker->text,
            'image' => "motorbikes/November2022/".$image,
        ];
    }
}
