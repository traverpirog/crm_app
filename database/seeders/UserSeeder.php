<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "example",
            "email" => "travorpirog@yandex.ru",
            "password" => Hash::make("password"),
            'role' => Roles::ADMIN,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            "name" => "example",
            "email" => "traver.unimmer@gmail.com",
            "password" => Hash::make("password"),
            'role' => Roles::ADMIN,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::factory(10)->create();
    }
}
