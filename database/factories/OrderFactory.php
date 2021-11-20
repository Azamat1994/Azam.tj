<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => \App\Models\User::all()->random(),
            'total' => $this->faker->randomFloat(1, 0, 1000000),
            'status_id' => \App\Models\Status::all()->random(),
        ];
    }
}


