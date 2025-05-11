@extends('layouts.app')

@section('title', $offer->title . ' - ' . $settings->site_name)
{{-- SEO için meta description da eklenebilir --}}
{{-- @section('meta_description', Str::limit(strip_tags($offer->description), 160)) --}}

@push('styles')
<style>
    .offer-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
    <div class="bg-white py-12">
        <div class="container mx-auto px-4">
            
            <!-- Breadcrumbs -->
            <div class="mb-8 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-green-700">Home</a>
                <span>&raquo;</span>
                <a href="#" class="hover:text-green-700">Offers</a> {{-- TODO: Offer index page link --}}
                <span>&raquo;</span>
                <span>{{ $offer->title }}</span>
            </div>

            <div class="lg:flex lg:space-x-12">
                <!-- Offer Image -->
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    @if($offer->image_path)
                        <img src="{{ Storage::url($offer->image_path) }}" alt="{{ $offer->title }}" class="rounded-lg shadow-lg w-full h-auto object-cover">
                    @else
                        <div class="w-full bg-gray-200 rounded-lg shadow-lg flex items-center justify-center aspect-[4/3]">
                            <p class="text-gray-500">Görsel Yok</p>
                        </div>
                    @endif
                </div>

                <!-- Offer Details -->
                <div class="lg:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold font-serif text-green-800 mb-4">{{ $offer->title }}</h1>
                    
                    <div class="text-3xl font-bold text-red-600 mb-6">
                        Special Price: ₺{{ number_format($offer->price, 2) }}
                    </div>

                    <div class="prose prose-lg text-gray-700 max-w-none mb-8 offer-content">
                        {!! $offer->description !!} {{-- Rich text editor içeriği olduğu için {!! !!} kullanıldı --}}
                    </div>

                    {{-- TODO: Add to cart button or other Call to Action --}}
                    <button class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg text-lg transition-colors">
                        Get This Offer
                    </button>
                    
                    {{-- Share buttons or other relevant info can go here --}}
                </div>
            </div>

            {{-- TODO: Related offers section --}}
            {{-- @if(isset($relatedOffers) && $relatedOffers->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">You Might Also Like</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($relatedOffers as $relatedOffer)
                            // related offer card similar to homepage
                        @endforeach
                    </div>
                </div>
            @endif --}}

        </div>
    </div>
@endsection 