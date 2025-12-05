<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->numberBetween(1, 3), // ← 追加！

            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->numerify('090########'),
            'address' => $this->faker->address(),   // ← 追加！

            'category_id' => $this->faker->numberBetween(1, 5),
            'message' => $this->faker->realText(50),
        ];
    }
}