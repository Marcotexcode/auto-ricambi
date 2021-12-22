<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now')
        ];
    }
}
