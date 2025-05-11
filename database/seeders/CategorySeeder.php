<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::truncate(); // Eğer her seferinde sıfırdan eklensin isteniyorsa

        $categories = [
            'Black Teas',
            'Green Teas',
            'Herbal Infusions',
            'Oolong Teas',
            'White Teas',
            'Pu-erh Teas',
            'Specialty Blends',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
        }
    }
}
