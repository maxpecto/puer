<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(rand(2, 4), true);
        $categoryIds = Category::pluck('id')->toArray();

        return [
            'category_id' => $this->faker->optional(0.9, null)->randomElement($categoryIds ?: [null]), // %90 ihtimalle bir kategori ata, yoksa null
            'name' => Str::title($name),
            'slug' => Str::slug($name . '-' . Str::random(4)),
            'description' => $this->faker->paragraphs(rand(2, 5), true),
            'price' => $this->faker->randomFloat(2, 5, 100), // 5.00 - 100.00 arasında fiyat
            // Şimdilik basit bir placeholder image kullanalım, daha sonra storage'a yüklenmiş gerçekçi demo görseller kullanılabilir.
            // 'image_path' => 'demo_images/' . $this->faker->randomElement(['tea1.jpg', 'tea2.jpg', 'tea3.jpg', 'tea4.jpg', 'tea5.jpg']), 
            'image_path' => null, // Veya null bırakıp admin panelinden eklenebilir
            'is_featured' => $this->faker->boolean(30), // %30 ihtimalle öne çıkan
            'is_active' => true,
        ];
    }
}
