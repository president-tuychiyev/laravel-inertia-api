<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name_uz' => "Integratsiyalashgan Vitros 5600 tizimi",
                'name_ru' => "Интегрированная система Vitros 5600",
                'name_en' => "Vitros 5600 Integrated System",
                'desc_uz' => "Description Integratsiyalashgan Vitros 5600 tizimi",
                'desc_ru' => "Description Интегрированная система Vitros 5600",
                'desc_en' => "Description Vitros 5600 Integrated System",
                'spec_uz' => "Specification Integratsiyalashgan Vitros 5600 tizimi",
                'spec_ru' => "Specification Интегрированная система Vitros 5600",
                'spec_en' => "Specification Vitros 5600 Integrated System",
                'brand_id' => 1,
                'country_id' => 1,
                'media_id' => 1
            ]
        ];

        Product::truncate();
        Product::insert($products);
    }
}
