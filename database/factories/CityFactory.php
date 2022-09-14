<?php

namespace Database\Factories;

use App\Domain\City\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->sentence(2, true),
        ];
    }
}
