<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $media = [
            [
                'base_name' => "default.jpg",
                'original_name' => "default.jpg",
                'src' => "/storage/products/default.jpg",
                'size' => "123456",
                'type' => "jpg",
            ]
        ];

        Media::truncate();
        Media::insert($media);
    }
}
