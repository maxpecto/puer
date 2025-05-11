@extends('layouts.app')

@section('title', __('Checkout') . ' - ' . ($settings['site_name'] ?? __('Chaai')))

@section('content')
    <div class="container mx-auto px-4 py-16">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-10 font-serif">{{ __('Checkout') }}</h1>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <p class="text-gray-700 text-lg">
                {{ __('This is the checkout page. Further implementation for payment and order processing will be added here.') }}
            </p>
            <div class="mt-8">
                <a href="{{ route('home') }}" class="text-green-600 hover:text-green-800 font-semibold">
                    &larr; {{ __('Back to Home') }}
                </a>
            </div>
        </div>
    </div>
@endsection 