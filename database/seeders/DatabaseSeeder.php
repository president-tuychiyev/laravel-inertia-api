<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            AttachSeeder::class,
            BrandSeeder::class,
            MediaSeeder::class
        ]);
    }
}
