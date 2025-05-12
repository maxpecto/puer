@if(isset($discoverMagicBlock) && $discoverMagicBlock)
<section id="discover-magic">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1 {{ $discoverMagicBlock->image_path ? '' : 'md:col-span-2 text-center' }}"> 
                <h2 class="text-3xl md:text-4xl font-bold font-serif text-green-800 mb-6">
                    {{ $discoverMagicBlock->title ?? __('Discover the Magic of Tea') }}
                </h2>
                <div class="prose prose-lg text-gray-700 max-w-none mb-8">
                    {!! $discoverMagicBlock->content !!}
                </div>
                @if($discoverMagicBlock->link_url && $discoverMagicBlock->link_text)
                    <a href="{{ $discoverMagicBlock->link_url }}"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg text-md transition-colors">
                        {{ $discoverMagicBlock->link_text }}
                    </a>
                @endif
            </div>
            @if($discoverMagicBlock->image_path)
            <div class="order-1 md:order-2">
                <img src="{{ Storage::url($discoverMagicBlock->image_path) }}" alt="{{ $discoverMagicBlock->title ?? __('Magic of Tea') }}" class="rounded-lg shadow-lg w-full h-auto object-cover" style="max-height: 500px;">
            </div>
            @endif
        </div>
    </div>
</section>
@else
<!-- 'discover-magic-cta' içerik bloğu bulunamadı veya aktif değil. Admin panelinden ilgili anahtarla bir içerik bloğu oluşturun. -->
@endif 