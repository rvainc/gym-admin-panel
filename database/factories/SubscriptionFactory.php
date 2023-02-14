<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
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
            'title' => $generator->words(4),
            'days' => $generator->numberBetween(1, 90),
            'price' => $generator->numberBetween(100, 100000),
        ];
    }
}
