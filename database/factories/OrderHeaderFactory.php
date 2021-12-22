<?php

namespace Database\Factories;

use App\Illuminate\OrderHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'product_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'quantity' => $this->faker->numberBetween($min = 1, $max = 50)
        ];
    }
}
