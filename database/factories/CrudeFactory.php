<?php

namespace Database\Factories;

use App\Models\Crude;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrudeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Crude::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'articul' => random_int(1000, 9999),
            'unit_id' => \App\Models\Unit::all()->random(),
            'quantity' => $this->faker->randomFloat(1, 0, 1000),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'image' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}




