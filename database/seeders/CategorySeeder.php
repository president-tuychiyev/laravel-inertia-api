<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categores = [
            [
                'name_uz' => "Laboratoriya diagnostikasi",
                'name_ru' => "Лабораторная диагностика",
                'name_en' => "Laboratory diagnostics",
            ],
            [
                'name_uz' => "Biokimyoviy analizatorlar",
                'name_ru' => "Биохимический анализатор",
                'name_en' => "Biochemical analyzers",
            ],
            [
                'name_uz' => "Gemostaz analizatori",
                'name_ru' => "Анализатор гемостаза",
                'name_en' => "Hemostasis analyzer",
            ]
        ];

        Category::truncate();
        Category::insert($categores);
    }
}
