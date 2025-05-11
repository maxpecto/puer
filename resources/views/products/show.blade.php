@extends('layouts.app')

@section('title', $product->name . ' - ' . ($settings['site_name'] ?? __('Chaai')))

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden md:flex">
            <div class="md:w-1/2">
                @if($product->image_path)
                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-auto md:h-full object-cover">
                @else
                    <img src="https://via.placeholder.com/600x400.png?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-auto md:h-full object-cover">
                @endif
            </div>
            <div class="md:w-1/2 p-8 md:p-12">
                <h1 class="text-4xl font-bold text-green-700 mb-4 font-serif">{{ $product->name }}</h1>
                
                <div class="text-3xl font-semibold text-green-600 mb-6">
                    ₼{{ number_format($product->price, 2) }} {{-- Currency needs localization --}}
                </div>
                
                <div class="prose prose-lg text-gray-700 mb-8">
                    {!! $product->description !!}
                </div>

                {{-- Add to Cart Button or other actions --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center mb-6">
                        <label for="quantity" class="mr-3 font-semibold text-gray-700">{{ __('Quantity') }}:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-20 p-2 border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-green-700 transition duration-300 text-lg">
                        {{ __('Add to Cart') }}
                    </button>
                </form>

                <div class="mt-8 text-sm text-gray-500">
                    <p><span class="font-semibold">{{ __('Category:') }}</span> {{ $product->category->name ?? __('Uncategorized') }}</p>
                    {{-- Add more product details if needed, e.g., SKU, stock status --}}
                </div>
            </div>
        </div>

        {{-- Related Products Section (Optional) --}}
        {{-- You can add a section here to show related products --}}
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-green-700 mb-6 font-serif">{{ __('You Might Also Like') }}</h2>
            {{-- Placeholder for related products --}}
            <p class="text-gray-600">{{ __('Related products will be shown here.') }}</p>
        </div>
    </div>
@endsection 