<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory(1000)
            ->has(Transaction::factory()->count(50))
            ->create();
    }
}
