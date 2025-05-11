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
        // Önce mevcut ürünleri temizleyebiliriz (isteğe bağlı)
        // Product::truncate(); // Eğer her seferinde sıfırdan eklensin isteniyorsa

        Product::factory()->count(20)->create();
    }
}
