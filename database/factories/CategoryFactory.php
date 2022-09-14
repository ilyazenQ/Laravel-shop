<?php

namespace Database\Factories;

use App\Domain\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
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
