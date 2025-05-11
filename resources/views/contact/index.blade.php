@extends('layouts.app')

@section('title', ($settings['contact_page_meta_title'] ?? __('Contact Us')) . ' - ' . ($settings['site_name'] ?? __('Chaai')))
@section('description', $settings['contact_page_meta_description'] ?? __('Get in touch with Chaai. We are here to answer your questions about our organic teas and products.'))

@section('content')
    <div class="container mx-auto px-4 py-16">
        <h1 class="text-4xl font-bold text-center text-green-700 mb-8 font-serif">{{ $settings['contact_page_title'] ?? __('Get In Touch') }}</h1>
        
        @if(!empty($settings['contact_page_subtitle']))
            <p class="text-center text-gray-600 mb-12 text-lg max-w-2xl mx-auto">{{ $settings['contact_page_subtitle'] }}</p>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            {{-- Contact Information Column --}}
            <div class="bg-white p-8 shadow-lg rounded-lg border border-gray-100">
                <h2 class="text-2xl font-semibold text-green-700 mb-6">{{ __('Contact Information') }}</h2>
                
                <div class="space-y-4 text-gray-700">
                    <div>
                        <h3 class="font-semibold text-lg text-green-600">{{ __('Address:') }}</h3>
                        <p>{{ $settings['contact_address'] ?? ($settings['footer_address'] ?? __('123 Tea Street, Flavor Town, CA 90210')) }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg text-green-600">{{ __('Phone:') }}</h3>
                        <p><a href="tel:{{ $settings['contact_phone'] ?? ($settings['footer_phone'] ?? __('+1234567890')) }}" class="hover:text-green-500">{{ $settings['contact_phone'] ?? ($settings['footer_phone'] ?? __('+1 234 567 890')) }}</a></p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg text-green-600">{{ __('Email:') }}</h3>
                        <p><a href="mailto:{{ $settings['contact_email'] ?? ($settings['footer_email'] ?? __('info@chaai.com')) }}" class="hover:text-green-500">{{ $settings['contact_email'] ?? ($settings['footer_email'] ?? __('info@chaai.com')) }}</a></p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg text-green-600">{{ __('Working Hours:') }}</h3>
                        <p>{{ $settings['working_hours_weekdays'] ?? __('Mon - Fri: 09:00 - 18:00') }}</p>
                        <p>{{ $settings['working_hours_weekend'] ?? __('Sat - Sun: 10:00 - 16:00') }}</p>
                    </div>
                </div>

                {{-- Social Media Links --}}
                @if(!empty($settings['facebook_url']) || !empty($settings['instagram_url']) || !empty($settings['twitter_url']) || !empty($settings['linkedin_url']))
                <div class="mt-8">
                    <h3 class="font-semibold text-lg text-green-600 mb-3">{{ __('Follow Us:') }}</h3>
                    <div class="flex space-x-4">
                        @if(!empty($settings['facebook_url']))
                            <a href="{{ $settings['facebook_url'] }}" target="_blank" class="text-gray-500 hover:text-green-600">
                                <i class="fab fa-facebook-f text-2xl"></i> {{-- Placeholder for actual SVG or FontAwesome --}}
                            </a>
                        @endif
                        @if(!empty($settings['instagram_url']))
                            <a href="{{ $settings['instagram_url'] }}" target="_blank" class="text-gray-500 hover:text-green-600">
                                <i class="fab fa-instagram text-2xl"></i> {{-- Placeholder for actual SVG or FontAwesome --}}
                            </a>
                        @endif
                        @if(!empty($settings['twitter_url']))
                            <a href="{{ $settings['twitter_url'] }}" target="_blank" class="text-gray-500 hover:text-green-600">
                                <i class="fab fa-twitter text-2xl"></i> {{-- Placeholder for actual SVG or FontAwesome --}}
                            </a>
                        @endif
                         @if(!empty($settings['linkedin_url']))
                            <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="text-gray-500 hover:text-green-600">
                                <i class="fab fa-linkedin-in text-2xl"></i> {{-- Placeholder for actual SVG or FontAwesome --}}
                            </a>
                        @endif
                        {{-- Add other social media icons similarly --}}
                    </div>
                </div>
                @endif
            </div>

            {{-- Contact Form Column (Placeholder) --}}
            <div class="bg-white p-8 shadow-lg rounded-lg border border-gray-100">
                <h2 class="text-2xl font-semibold text-green-700 mb-6">{{ __('Send Us a Message') }}</h2>
                <p class="text-gray-600 mb-4">{{ __('Have a question or want to say hello? Fill out the form below and we\'ll get back to you as soon as possible.') }}</p>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">{{ __('Full Name') }}</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">{{ __('Email Address') }}</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 font-medium mb-2">{{ __('Subject') }}</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-medium mb-2">{{ __('Message') }}</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-green-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300 text-lg">{{ __('Send Message') }}</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Google Map Section (Placeholder) --}}
        <div class="mt-16 bg-white p-2 shadow-lg rounded-lg border border-gray-100">
             <h2 class="text-2xl font-semibold text-green-700 mb-6 text-center">{{ __('Find Us On Map') }}</h2>
            {{-- Placeholder for Google Map Embed --}}
            <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-md flex items-center justify-center">
                <p class="text-gray-500">{{ __('Google Map will be embedded here.') }}</p>
            </div>
        </div>
    </div>
@endsection 