<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $roles = [
            'supervisor',
            'operator'
        ];

        User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@email.com',
            'password' => Hash::make('super12345'),
            'role' =>  $roles[0]
        ]);

        User::factory()->create([
            'name' => 'April',
            'email' => 'april@email.com',
            'password' => Hash::make('staff12345'),
            'role' => $roles[1]
        ]);
    }
}
