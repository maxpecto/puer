@extends('layouts.app')

@section('content')
    <!-- Hero Section Start -->
    <section class="relative h-screen flex items-center justify-center text-center bg-cover bg-center"
             style="background-image: url('{{ !empty($settings['hero_background_image']) ? Storage::url($settings['hero_background_image']) : 'https://via.placeholder.com/1920x1080.png?text=Hero+Background' }}');">
        <div class="absolute inset-0 bg-black opacity-30"></div> <!-- Overlay -->
        <div class="relative z-10 px-4">
            <h1 class="text-5xl md:text-7xl font-bold font-serif text-white mb-6 leading-tight">
                {{ $settings['hero_title'] ?? __('The Cup Of Life') }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto">
                {{ $settings['hero_subtitle'] ?? __('Lorem ipsum sit dolar amet is consectur adispicing elit.') }}
            </p>
            <a href="{{ $settings['hero_button_link'] ?? '#shop' }}" 
               style="background: var(--button-primary-bg-color); color: var(--button-primary-text-color);"
               class="font-semibold py-3 px-8 rounded-lg text-lg transition-colors">
                {{ $settings['hero_button_text'] ?? __('Shop Now') }}
            </a>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Health Benefits Section Start -->
    @include('partials.home.health-benefits', ['noPadding' => true])
    <!-- Health Benefits Section End -->

    {{--
    <!-- Featured Products Section Start -->
    @include('partials.home.featured-products')
    <!-- Featured Products Section End -->
    --}}

    <!-- Popular Offers Section Start -->
    @include('partials.home.popular-offers', ['noPadding' => true])
    <!-- Popular Offers Section End -->

    <!-- Discover The Magic of Tea Section Start -->
    @include('partials.home.discover-magic', ['noPadding' => true])
    <!-- Discover The Magic of Tea Section End -->

    <!-- Testimonials Section Start -->
    @include('partials.home.testimonials', ['noPadding' => true])
    <!-- Testimonials Section End -->

    <!-- Instagram Gallery Section Start -->
    @include('partials.home.instagram-gallery', ['noPadding' => true])
    <!-- Instagram Gallery Section End -->

@endsection
