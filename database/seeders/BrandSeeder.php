<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Horiba'
            ],
            [
                'name' => 'Artel'
            ],
            [
                'name' => '7saber'
            ],
            [
                'name' => 'Nike'
            ]
        ];

        Brand::truncate();
        Brand::insert($brands);
    }
}
