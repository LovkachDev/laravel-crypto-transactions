<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender'    => $this->faker->bothify('##############'),
            'recipient' => $this->faker->lexify('??????????????'),
            'amount'    => $this->faker->randomFloat(3),
            'status'    => 'complete'
        ];
    }
}