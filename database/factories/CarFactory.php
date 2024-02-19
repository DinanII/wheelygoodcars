<?php

namespace Database\Factories;

use App\Models\User;
use \App\Models\Car;
use \App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $team1Id = Team::inRandomOrder()->first()->id;
        // $team2Id = Team::where('id', '!=', $team1Id)->inRandomOrder()->first()->id;
        // $refereeId = User::inRandomOrder()->first()->id;

        $owner = User::inRandomOrder()->first()->id;
        return [
            'user_id' => $owner,
            'license_plate' => fake()->word(),
            'make' => fake()->word(),
            'model' => fake()->word(),
            'price' => fake()->randomFloat(1, 950, 120000),
            'mileage' => fake()->randomNumber(),
            'seats' => fake()->numberBetween(1, 8),
            'doors' => fake()->numberBetween(0, 4),
            'production_year' => fake()->numberBetween(1960, 2024),
            'weight' => fake()->numberBetween(780, 7800),
            'color' => fake()->colorName(),
            'image' => 'https://picsum.photos/200/300',
            'sold_at' => fake()->dateTimeBetween('-3 years'),
            'views' => fake()->numberBetween(0, 1500)
        ];
    }
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Car $car) {
            $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id')->toArray();
            $car->tags()->sync($tags);
        });
    }
}
