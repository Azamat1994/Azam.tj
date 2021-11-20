<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

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
            'description' => $this->faker->realText(100),
            'size' => $this->faker->numberBetween(20, 50),
//            'width' => $this->faker->randomFloat(1, 5, 15),
//            'girth' => $this->faker->randomFloat(1, 20, 60),
            'quantity' => $this->faker->randomFloat(1, 0, 1000000),
            'image' => $this->faker->imageUrl(),
            'cost' => $this->faker->randomFloat(2, 0, 1000000),
            'markup' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 0, 1000000),
            'category_id' => \App\Models\Category::all()->random(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
