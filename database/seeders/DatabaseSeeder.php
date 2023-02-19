<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $items = [
            [
                'title' => '1 місяць',
                'days' => 30,
                'price' => 50000,
            ],
            [
                'title' => '1 день',
                'days' => 1,
                'price' => 7000,
            ],
            [
                'title' => '15 днів',
                'days' => 15,
                'price' => 30000,
            ],
        ];

        foreach ($items as $item) {
            Subscription::factory()->create($item);
        }
        User::factory()->create([
            'name' => 'admin',
            'email' => 'rudvamailbox@gmail.com',
            'email_verified_at' => null,
            'role' => 1,
            'password' => bcrypt('331832'),
            'remember_token' => Str::random(10),
        ]);
    }
}
