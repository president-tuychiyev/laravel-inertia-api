<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            'name' => 'Javlonbek Tuychiyev',
            'email' => 'medol@example.com',
            'password' => Hash::make('123456'),
            'role_id' => 2
        ];

        User::truncate();
        User::insert($users);
    }
}
