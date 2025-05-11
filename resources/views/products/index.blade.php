@extends('layouts.app')

@section('title', __('Our Products') . ' - ' . ($settings['site_name'] ?? __('Chaai')))

@section('content')
    <div class="container mx-auto px-4 py-16">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-6 font-serif">{{ $settings['products_page_title'] ?? __('Explore Our Teas') }}</h1>

        @if(!empty($settings['products_page_subtitle']))
            <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto">{{ $settings['products_page_subtitle'] }}</p>
        @endif

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @foreach($products as $product)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 border border-gray-100 hover:shadow-xl">
                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                            @if($product->image_path)
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <img src="https://via.placeholder.com/300x200.png?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-green-700 mb-2 h-16 overflow-hidden">{{ $product->name }}</h3>
                                {{-- <p class="text-gray-600 text-sm mb-3 h-12 overflow-hidden">{{ Str::limit($product->description, 50) }}</p> --}}
                                <p class="text-2xl font-bold text-green-600 mb-4">₼{{ number_format($product->price, 2) }}</p>
                                <span class="inline-block bg-green-600 text-white text-base px-5 py-3 font-medium rounded-full hover:bg-green-700 transition duration-300">{{ __('View Details') }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-16">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15V7.5M3 7.5h18M5.25 7.5h13.5m-13.5 0V6a1.5 1.5 0 011.5-1.5h10.5a1.5 1.5 0 011.5 1.5v1.5m-13.5 0h13.5" />
                </svg>
                <h3 class="mt-4 text-2xl font-semibold text-gray-700">{{ __('No Teas to Explore Yet') }}</h3>
                <p class="mt-2 text-lg text-gray-500">{{ __('We\'re brewing up new products. Please check back soon!') }}</p>
            </div>
        @endif
    </div>
@endsection 