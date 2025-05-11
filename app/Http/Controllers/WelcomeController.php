<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\GalleryImage;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page.
     */
    public function index(): View
    {
        $healthBenefitsBlock = ContentBlock::where('key', 'health-benefits')->where('is_active', true)->first();
        
        // Öne çıkan ürünleri alalım (örneğin ilk 4 ürün)
        $featuredProducts = Product::where('is_featured', true)
                                   ->where('is_active', true) // Aktif ürünleri de kontrol edelim
                                   ->orderBy('updated_at', 'desc') // En son güncellenenler veya başka bir sıralama
                                   ->take(4) // İlk 4 ürünü al
                                   ->get();

        // Aktif teklifleri alalım (örneğin ilk 3 teklif)
        $popularOffers = Offer::where('is_active', true)
                                ->orderBy('updated_at', 'desc') // En son güncellenenler
                                ->take(3) // İlk 3 teklifi al
                                ->get();

        $discoverMagicBlock = ContentBlock::where('key', 'discover-magic-cta')->where('is_active', true)->first();

        // Görünür müşteri yorumlarını alalım (örneğin ilk 3 yorum)
        $testimonials = Testimonial::where('is_visible', true)
                                    ->orderBy('created_at', 'desc') // En son eklenenler
                                    ->take(3) // İlk 3 yorumu al
                                    ->get();

        // Instagram galerisi için görselleri alalım
        $instagramImages = GalleryImage::where('group_key', 'instagram-feed')
                                        ->where('is_active', true)
                                        ->orderBy('display_order', 'asc') // Belirlenen sıraya göre
                                        ->orderBy('created_at', 'desc') // Veya eklenme tarihine göre
                                        ->take(6) // Örneğin ilk 6 görsel
                                        ->get();

        return view('welcome', [
            'healthBenefitsBlock' => $healthBenefitsBlock,
            'featuredProducts' => $featuredProducts,
            'popularOffers' => $popularOffers,
            'discoverMagicBlock' => $discoverMagicBlock,
            'testimonials' => $testimonials,
            'instagramImages' => $instagramImages,
        ]);
    }
}
