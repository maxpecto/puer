@if(isset($instagramImages) && $instagramImages->count() > 0)
<section id="instagram-gallery" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold font-serif text-green-800 mb-4">
                {{ $settings['instagram_gallery_title'] ?? __('Follow Us on Instagram') }}
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ $settings['instagram_gallery_subtitle'] ?? __('Get inspired by our latest posts and tea moments.') }}
                 @if(isset($settings) && !empty($settings['instagram_url']))
                    <a href="{{ $settings['instagram_url'] }}" target="_blank" class="text-green-600 hover:text-green-700 font-semibold">@ {{ $settings['instagram_handle'] ?? __('ChaaiPuerh') }}</a>
                @endif
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-1 sm:gap-2">
            @foreach($instagramImages as $image)
                <div class="aspect-w-1 aspect-h-1 overflow-hidden group">
                    <a href="{{ $image->link_url ?? (isset($settings) && !empty($settings['instagram_url']) ? $settings['instagram_url'] : '#') }}" 
                       target="_blank" 
                       title="{{ $image->title ?? __('View on Instagram') }}"
                       class="block w-full h-full">
                        <img src="{{ Storage::url($image->image_path) }}" 
                             alt="{{ $image->caption ?? $image->title ?? __('Instagram Image') }}" 
                             class="w-full h-full object-cover group-hover:opacity-80 transition-opacity duration-300">
                        @if($image->caption || $image->title)
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center p-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-xs sm:text-sm">{{ $image->title ?? Str::limit($image->caption, 50) }}</p>
                        </div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@else
<!-- 'instagram-feed' grubuna ait aktif galeri görseli bulunamadı. Admin panelinden ilgili grup anahtarıyla görseller ekleyin. -->
@endif 