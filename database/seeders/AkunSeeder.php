<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                "name"=> "admin",
                "email"=> "admin@gmail.com",
                "password"=> Hash::make("passwordadmin"),
            ],
            [
                "name"=> "admin",
                "email"=> "user@gmail.com",
                "password"=> Hash::make("passworduser"),
            ],
            ]);
    }
}
