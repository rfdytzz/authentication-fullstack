<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'rafka@mail.com',
            'name' => 'Rafka Dyta',
            'password' => '12345678',
            'role' => 'Admin'
        ]);
    }
}
