@if(isset($healthBenefitsBlock) && $healthBenefitsBlock)
<section id="health-benefits">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                @if($healthBenefitsBlock->image_path)
                    <img src="{{ Storage::url($healthBenefitsBlock->image_path) }}" alt="{{ $healthBenefitsBlock->title ?? __('Health Benefits') }}" class="rounded-lg shadow-lg w-full h-auto object-cover" style="max-height: 450px;">
                @else
                    <div class="w-full h-96 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center">
                        <p class="text-gray-500">{{ __('Görsel Bekleniyor') }}</p>
                    </div>
                @endif
            </div>
            <div>
                <h2 class="text-3xl md:text-4xl font-bold font-serif text-green-800 mb-6">
                    {{ $healthBenefitsBlock->title ?? __('Discover the Health Benefits of Our Teas') }}
                </h2>
                <div class="prose prose-lg text-gray-700 max-w-none">
                    {!! $healthBenefitsBlock->content !!}
                </div>
                @if($healthBenefitsBlock->link_url && $healthBenefitsBlock->link_text)
                    <a href="{{ $healthBenefitsBlock->link_url }}"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg text-md transition-colors mt-8">
                        {{ $healthBenefitsBlock->link_text }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@else
<!-- Sağlık faydaları bloğu bulunamadı veya aktif değil. Admin panelinden 'health-benefits' anahtarıyla bir içerik bloğu oluşturun. -->
@endif 