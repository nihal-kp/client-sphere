<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserType;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::updateOrCreate([
            'email' => 'admin@test.com'
        ],
        [
            'name' => 'Admin',
            'phone' => '1234567890',
            'type' => UserType::ADMIN,
            'status' => UserStatus::ACTIVE,
            'password' => Hash::make('Admin@123'),
        ]);

    }
}
