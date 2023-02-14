<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $generator = fake('uk_UA');
        $subscription = Subscription::query()->inRandomOrder()->first();
        $customer = Customer::query()->inRandomOrder()->first();
        $start_at = Carbon::instance($generator->dateTimeBetween('-3 years'));

        return [
            'amount' => $subscription->price,
            'subscription_id' => $subscription->id,
            'customer_id' => $customer->id,
            'start_at' => $start_at,
            'ends_at' => $start_at->clone()->addDays($subscription->days),
        ];
    }
}
