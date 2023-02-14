<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $generator = fake('uk_UA');

        return [
            'first_name' => $generator->firstName,
            'last_name' => $generator->lastName,
            'phone_number' => $generator->unique()->e164PhoneNumber(),
            'card_number' => $generator->unique()->creditCardNumber(),
            'image' => $generator->imageUrl(),
        ];
    }
}
