<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;
use App\Models\Car;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Car_TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tag = Tag::inRandomOrder()->first()->id;
        $car = Car::inRandomOrder()->first()->id;

        return [
            'tag_id' => $tag,
            'car_id' => $car
        ];
    }
}
