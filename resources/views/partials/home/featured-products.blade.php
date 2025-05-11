@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<section id="featured-products" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold font-serif text-green-800 mb-4">
                {{ $settings->featured_products_title ?? __('Unique Tea Blends') }}
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ $settings->featured_products_subtitle ?? __('Discover our handpicked selection of the finest organic teas from around the world.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                    <div class="relative h-64 w-full overflow-hidden">
                        <img src="{{ $product->image_path ? Storage::url($product->image_path) : 'https://via.placeholder.com/400x300.png?text=Tea+Image' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 ease-in-out">
                        @if($product->is_featured) <!-- Bu etiketi ayrıca göstermek isteyebilirsiniz -->
                            <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">{{ __('Featured') }}</span>
                        @endif
                             <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('products.show', $product->slug) }}" class="text-white bg-green-600 hover:bg-green-700 py-2 px-4 rounded-lg text-sm font-semibold">
                                    {{ __('View Product') }}
                                </a>
                             </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold font-serif text-green-800 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 h-12 overflow-hidden">
                            {{ Str::limit($product->description, 60) }} 
                        </p>
                        <p class="text-xl font-bold text-green-600 mb-4">₼{{ number_format($product->price, 2) }}</p>
                        <a href="#" class="w-full block bg-gray-200 hover:bg-green-600 hover:text-white text-green-700 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                            {{ __('Add to Cart') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if(isset($settings) && !empty($settings['shop_page_url']))
        <div class="text-center mt-12">
            <a href="{{ $settings['shop_page_url'] }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition-colors">
                {{ $settings['view_all_products_button_text'] ?? __('View All Teas') }}
            </a>
        </div>
        @endif
    </div>
</section>
@else
<!-- Öne çıkan ürün bulunamadı. Admin panelinden bazı ürünleri 'Öne Çıkan' olarak işaretleyin. -->
@endif 