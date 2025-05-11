@if(isset($popularOffers) && $popularOffers->count() > 0)
    @php
        // Şimdilik ilk popüler teklifi alıyoruz. Birden fazla göstermek için döngü kullanılabilir.
        $mainOffer = $popularOffers->first(); 
    @endphp
    <section id="popular-offers" class="py-16 bg-green-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold font-serif text-green-800 mb-4">
                    {{ $settings['popular_offers_title'] ?? __('Special Offers Just For You') }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ $settings['popular_offers_subtitle'] ?? __('Don\'t miss out on our exclusive deals and seasonal promotions.') }}
                </p>
            </div>

            @if($mainOffer)
            <div class="bg-white rounded-lg shadow-xl overflow-hidden md:flex">
                <div class="md:w-1/2">
                    <img src="{{ $mainOffer->image_path ? Storage::url($mainOffer->image_path) : 'https://via.placeholder.com/800x600.png?text=Special+Offer' }}" 
                         alt="{{ $mainOffer->title }}" 
                         class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                    <h3 class="text-3xl font-bold font-serif text-green-800 mb-4">{{ $mainOffer->title }}</h3>
                    <p class="text-gray-700 mb-3 text-lg">
                        {{ $mainOffer->description }}
                    </p>
                    <p class="text-2xl font-bold text-red-600 mb-6">
                        {{ __('Special Price:') }} {{-- Para birimi və formatı yerel ayarlara göre düzenlenebilir --}}₼{{ number_format($mainOffer->price, 2) }}
                    </p>
                    <a href="{{ $mainOffer->slug ? route('offer.show', $mainOffer->slug) : '#' }}" 
                       class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition-colors self-start">
                        {{ __('View Offer Details') }}
                    </a>
                </div>
            </div>
            @endif

            {{-- Birden fazla teklif göstermek istenirse burası genişletilebilir --}}
            @if($popularOffers->count() > 1)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-12">
                    @foreach($popularOffers->skip(1)->take(2) as $offer) {{-- İlk tekliften sonraki 2 teklif --}}
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $offer->image_path ? Storage::url($offer->image_path) : 'https://via.placeholder.com/400x300.png?text=Offer' }}" alt="{{ $offer->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold font-serif text-green-700 mb-2">{{ $offer->title }}</h4>
                                <p class="text-gray-600 text-sm mb-2 h-10 overflow-hidden">{{ Str::limit($offer->description, 50) }}</p>
                                <p class="text-lg font-bold text-red-500 mb-3">{{-- Para birimi --}}₼{{ number_format($offer->price, 2) }}</p>
                                <a href="{{ $offer->slug ? route('offer.show', $offer->slug) : '#' }}" class="text-green-600 hover:text-green-700 font-semibold text-sm">{{ __('Learn More') }} &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@else
<!-- Aktif popüler teklif bulunamadı. Admin panelinden teklifleri 'Aktif' olarak işaretleyin. -->
@endif 