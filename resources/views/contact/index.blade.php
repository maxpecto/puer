@extends('layouts.app')

@section('title', ($settings['contact_page_meta_title'] ?? __('Contact Us')) . ' - ' . ($settings['site_name'] ?? __('Chaai')))
@section('description', $settings['contact_page_meta_description'] ?? __('Get in touch with Chaai. We are here to answer your questions about our organic teas and products.'))

@push('styles')
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        #mapbox-map {
            height: 450px;
            border-radius: 0.5rem; /* rounded-lg */
        }
        .mapboxgl-popup-content {
            font-family: 'Montserrat', sans-serif;
            padding: 10px 15px;
            border-radius: 6px;
        }
        .contact-icon {
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 0.75rem;
            color: var(--contact-icon-color, var(--accent-color));
        }
        .contact-section-bg {
            background: var(--background-color);
        }
        .contact-title {
            /* color: var(--contact-title-color, var(--header-link-color, #15803d)); */
            color: var(--contact-title-color-dynamic);
        }
        .contact-subtitle {
            color: var(--contact-subtitle-color, var(--secondary-text-color, #4b5563));
        }
        .contact-box-bg {
            background: var(--surface-color);
        }
        .contact-box-shadow {
            /* box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.1), 0 4px 6px -2px rgba(16, 185, 129, 0.05); */ /* Köhnə yaşıl kölgə */
            box-shadow: 0 10px 25px -5px rgba(226, 114, 91, 0.1), 0 4px 6px -2px rgba(226, 114, 91, 0.05); /* Yeni Terrakota kölgəsi (E2725B -> rgb(226, 114, 91)) */
        }
        .contact-label {
            /* color: var(--contact-label-color, var(--text-color, #374151)); */
            color: var(--contact-label-color-dynamic);
        }
        .contact-input {
            background-color: var(--contact-form-input-bg) !important;
            color: var(--contact-form-input-text) !important;
            border-color: var(--contact-form-input-border) !important;
        }
        .contact-input:focus {
            border-color: var(--contact-form-input-focus) !important;
            box-shadow: 0 0 0 1px var(--contact-form-input-focus) !important;
        }
        .contact-btn {
            background: var(--button-primary-bg-color);
            color: var(--button-primary-text-color);
        }
        .contact-btn:hover {
            background: var(--button-primary-bg-color);
            filter: brightness(0.9);
        }
        .contact-alert-success {
            background: var(--surface-color);
            border-left: 4px solid var(--secondary-color);
            color: var(--text-color);
        }
        .contact-alert-error {
            background: var(--contact-error-bg, #fee2e2);
            border-left: 4px solid var(--contact-error-border, #ef4444);
            color: var(--contact-error-text, #991b1b);
        }
        .contact-social-icon { /* NEW class for icons only */
            /* color: var(--contact-social-color, #6b7280); */
            color: var(--contact-social-icon-color);
            /* background: var(--contact-social-bg, #f3f4f6); */ /* Removed background */
        }
        .contact-social-icon:hover { /* NEW class for icons only */
            /* color: var(--contact-social-hover, var(--accent-color, #15803d)); */
            color: var(--contact-social-icon-hover-color);
            /* background: var(--contact-social-bg-hover, #d1fae5); */ /* Removed background hover */
        }
    </style>
@endpush

@section('content')
    <div class="contact-section-bg pt-24 pb-12 md:pt-32 md:pb-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h1 class="text-3xl md:text-4xl font-bold contact-title mb-4 font-serif tracking-tight">{{ $settings['contact_page_title'] ?? __('Bizimlə Əlaqə Saxlayın') }}</h1>
                @if(!empty($settings['contact_page_subtitle']))
                    <p class="text-lg md:text-xl contact-subtitle max-w-2xl mx-auto">{{ $settings['contact_page_subtitle'] }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12 contact-box-bg p-6 md:p-10 rounded-xl contact-box-shadow">
                {{-- Contact Information Column --}}
                <div class="lg:col-span-5 space-y-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold contact-title mb-6 font-serif">{{ __('Əlaqə Məlumatları') }}</h2>
                        <div class="space-y-5" style="color: var(--contact-info-text, var(--text-color, #374151));">
                            @if(!empty($settings['contact_address']) || !empty($settings['footer_address']))
                            <div class="flex items-start">
                                <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color-dynamic);">{{ __('Address:') }}</h3>
                                    <p style="color: var(--contact-info-secondary-color);">{{ $settings['contact_address'] ?? ($settings['footer_address'] ?? __('123 Tea Street, Flavor Town, CA 90210')) }}</p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['contact_phone']) || !empty($settings['footer_phone']))
                            <div class="flex items-start">
                                <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.308 1.155a11.034 11.034 0 005.656 5.656l1.155-2.308a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color-dynamic);">{{ __('Phone:') }}</h3>
                                    <p><a href="tel:{{ $settings['contact_phone'] ?? ($settings['footer_phone'] ?? '+1234567890') }}" style="color: var(--contact-info-secondary-color);" class="hover:underline">{{ $settings['contact_phone'] ?? ($settings['footer_phone'] ?? __('+1 234 567 890')) }}</a></p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['contact_email']) || !empty($settings['footer_email']))
                            <div class="flex items-start">
                                 <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color-dynamic);">{{ __('Email:') }}</h3>
                                    <p><a href="mailto:{{ $settings['contact_email'] ?? ($settings['footer_email'] ?? 'info@chaai.com') }}" style="color: var(--contact-info-secondary-color);" class="hover:underline">{{ $settings['contact_email'] ?? ($settings['footer_email'] ?? __('info@chaai.com')) }}</a></p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['working_hours_weekdays']) || !empty($settings['working_hours_weekend']))
                            <div class="flex items-start">
                                <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color-dynamic);">{{ __('Working Hours:') }}</h3>
                                    @if(!empty($settings['working_hours_weekdays'])) <p style="color: var(--contact-info-secondary-color);">{{ $settings['working_hours_weekdays'] }}</p> @endif
                                    @if(!empty($settings['working_hours_weekend'])) <p style="color: var(--contact-info-secondary-color);">{{ $settings['working_hours_weekend'] }}</p> @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Social Media Links --}}
                    @if(!empty($settings['facebook_url']) || !empty($settings['instagram_url']) || !empty($settings['twitter_url']) || !empty($settings['linkedin_url']) || !empty($settings['pinterest_url']) || !empty($settings['youtube_url']) || !empty($settings['whatsapp_number']))
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-xl" style="color: var(--contact-label-color-dynamic);">{{ __('Follow Us & Chat:') }}</h3>
                        <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2 items-center">
                            @if(!empty($settings['facebook_url']))
                                <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social-icon transition-colors duration-200 group" aria-label="{{ __('Facebook') }}">
                                    <svg role="img" viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82V14.706h-3.454V11.08h3.454V8.413c0-3.426 2.1-5.278 5.165-5.278.926 0 1.852.068 2.78.168v3.24h-1.918c-1.664 0-1.987.79-1.987 1.951v2.553h3.587l-.467 3.626H16.57V24h6.105c.732 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg>
                                </a>
                            @endif
                            @if(!empty($settings['instagram_url']))
                                <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social-icon transition-colors duration-200 group" aria-label="{{ __('Instagram') }}">
                                    <svg role="img" viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.784.305-1.457.717-2.123 1.383S.935 3.356.63 4.14C.333 4.905.132 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.26 2.148.558 2.913.306.783.718 1.457 1.384 2.123.667.666 1.34 1.078 2.124 1.383.766.296 1.636.498 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.783-.305 1.457-.718 2.123-1.383.666-.667 1.078-1.34 1.383-2.123.296-.765.498-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.148-.558-2.913-.305-.784-.718-1.457-1.383-2.124C21.065.935 20.393.522 19.63.218 18.867.06 17.997 0 16.947 0H12zm0 2.16c3.203 0 3.585.01 4.85.07 1.17.052 1.805.242 2.227.415.562.227.96.497 1.382.92s.693.82.92 1.382c.173.422.363 1.057.415 2.227.06 1.265.07 1.646.07 4.85s-.01 3.585-.07 4.85c-.052 1.17-.242 1.805-.415 2.227-.227.562-.497.96-.92 1.382s-.82.693-1.382.92c-.422.173-1.057.363-2.227.415-1.265.06-1.646.07-4.85.07s-3.585-.01-4.85-.07c-1.17-.052-1.805-.242-2.227-.415-.562-.227-.96-.497-1.382-.92s-.693-.82-.92-1.382c-.173-.422-.363-1.057-.415-2.227-.06-1.265-.07-1.646-.07-4.85s.01-3.585.07-4.85c.052-1.17.242 1.805.415 2.227.227-.562.497.96.92-1.382s.82-.693 1.382-.92c.422-.173 1.057.363 2.227.415C8.415 2.17 8.797 2.16 12 2.16zm0 3.81c-3.403 0-6.162 2.76-6.162 6.162s2.76 6.162 6.162 6.162 6.162-2.76 6.162-6.162S15.403 5.97 12 5.97zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.44.645-1.44 1.44s.645 1.44 1.44 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                            @endif
                            @if(!empty($settings['twitter_url']))
                                <a href="{{ $settings['twitter_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social-icon transition-colors duration-200 group" aria-label="{{ __('X (Twitter)') }}">
                                    <svg role="img" viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>X</title><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/></svg>
                                </a>
                            @endif
                             @if(!empty($settings['pinterest_url']))
                                <a href="{{ $settings['pinterest_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social-icon transition-colors duration-200 group" aria-label="{{ __('Pinterest') }}">
                                    <svg role="img" viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Pinterest</title><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.198-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.377-.752-.377-1.845c0-1.713 1.002-2.981 2.245-2.981.994 0 1.469.746 1.469 1.641 0 .988-.631 2.477-.963 3.855-.273 1.117.564 2.032 1.666 2.032 2.007 0 3.559-2.119 3.559-5.188 0-2.633-1.914-4.515-4.748-4.515-3.261 0-5.174 2.436-5.174 4.934 0 .969.335 1.928.731 2.527.079.122.093.234.038.462-.172.777-.571 2.348-.722 2.938-.098.388-.405.47-.712.158-1.407-.943-2.205-2.981-2.981-4.662 0-3.788 2.755-7.262 7.928-7.262 4.159 0 7.392 2.967 7.392 6.922 0 4.131-2.625 7.468-6.248 7.468-1.211 0-2.348-.63-2.741-1.373 0 0-.598 2.282-.71 2.737-.228.906-.899 1.711-1.392 2.337.979.322 2.016.491 3.088.491 6.626 0 11.988-5.361 11.988-11.979C23.998 5.368 18.636 0 12.017 0Z"/></svg>
                                </a>
                            @endif
                            @if(!empty($settings['linkedin_url']))
                                <a href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social-icon transition-colors duration-200 group" aria-label="{{ __('LinkedIn') }}">
                                    <svg role="img" viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>LinkedIn</title><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
                                </a>
                            @endif
                            @if(!empty($settings['youtube_url']))
                                <a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social-icon transition-colors duration-200 group" aria-label="{{ __('YouTube') }}">
                                    <svg role="img" viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>YouTube</title><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            @endif
                            @if(!empty($settings['whatsapp_number']))
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) }}" target="_blank" rel="noopener noreferrer" class="contact-social-icon transition-colors duration-200 group" aria-label="{{ __('WhatsApp') }}">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>WhatsApp</title><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.38 1.25 4.85L2 22l5.25-1.38c1.47.79 3.1 1.25 4.85 1.25 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2M8.42 7.37c.12-.24.36-.36.6-.36.24 0 .54.12.66.12.12 0 .24.06.36.36s.36.66.36.78c0 .12-.06.24-.12.36-.06.12-.12.18-.18.24-.12.06-.18.12-.24.12l-.12.06c-.24.18-.42.42-.6.66-.12.24-.3.42-.36.6.06.24.3.54.66.84.42.36.72.6.9.72.24.12.36.12.48.12.12 0 .24-.06.3-.12.24-.18.42-.48.6-.72.12-.18.24-.24.42-.24.12 0 .3.06.42.12l1.8.9c.12.06.18.12.24.18.06.12.06.24 0 .36-.18.3-.48.54-.78.72-.18.12-.36.18-.6.18-.66 0-1.26-.18-1.8-.48-.6-.36-1.26-.84-1.92-1.44-.72-.66-1.26-1.44-1.62-2.28-.12-.3-.12-.54-.06-.78.06-.12.12-.3.24-.42m3.62-5.13c4.39 0 7.96 3.57 7.96 7.96s-3.57 7.96-7.96 7.96-7.96-3.57-7.96-7.96 3.57-7.96 7.96-7.96m0-1.88C6.65 2.12 2.12 6.65 2.12 12.04s4.53 9.91 9.91 9.91 9.91-4.53 9.91-9.91S17.42 2.12 12.04 2.12z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Contact Form Column --}}
                <div class="lg:col-span-7">
                    <h2 class="text-2xl md:text-3xl font-semibold contact-title mb-6 font-serif">{{ $settings['contact_form_title'] ?? __('Send Us a Message') }}</h2>
                    @if(session('success'))
                        <div class="contact-alert-success p-4 mb-6 rounded-md" role="alert">
                            <p class="font-bold">{{ __('Success') }}</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if(session('error'))
                         <div class="contact-alert-error p-4 mb-6 rounded-md" role="alert">
                            <p class="font-bold">{{ __('Error') }}</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="contact-alert-error p-4 mb-6 rounded-md" role="alert">
                            <p class="font-bold">{{ __('Validation Error') }}</p>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium contact-label mb-1">{{ __('Full Name') }} <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" required >
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium contact-label mb-1">{{ __('Email Address') }} <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" required >
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium contact-label mb-1">{{ __('Phone Number') }} ({{ __('Optional') }})</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" >
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium contact-label mb-1">{{ __('Subject') }}</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" >
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium contact-label mb-1">{{ __('Message') }} <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="5" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" required >{{ old('message') }}</textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium contact-btn transition-all duration-150 ease-in-out">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                {{ __('Send Message') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Mapbox Map Section --}}
            <div class="mt-16 md:mt-20">
                 <h2 class="text-2xl md:text-3xl font-semibold contact-title mb-8 text-center font-serif">{{ $settings['contact_map_title'] ?? __('Find Us On Map') }}</h2>
                
                @if(!empty($settings['mapbox_api_key']) && !empty($settings['mapbox_latitude']) && !empty($settings['mapbox_longitude']))
                    <div id="mapbox-map" class="w-full shadow-xl border border-gray-200 rounded-lg overflow-hidden"></div>
                    <div class="mt-6 text-center">
                        <a id="get-directions-btn" 
                           href="#" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-lg font-semibold rounded-md contact-btn">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 16.382V5.618a1 1 0 00-1.447-.894L15 7m-6 13v-0m0 0V7"></path></svg>
                            {{ __('Get Directions') }}
                        </a>
                    </div>
                @elseif(!empty($settings['google_maps_iframe']))
                    <div class="bg-white p-2 shadow-lg rounded-lg border" style="border-color: var(--contact-map-border, #f3f4f6);">
                        <div class="aspect-w-16 aspect-h-9" style="background: var(--contact-map-bg, #e5e7eb); border-radius: 0.5rem; overflow: hidden;">
                            {!! $settings['google_maps_iframe'] !!}
                        </div>
                    </div>
                @else
                    <div class="bg-gray-100 p-8 rounded-lg text-center" style="color: var(--contact-info-secondary, var(--secondary-text-color, #4b5563)); background: var(--contact-map-bg, #e5e7eb);">
                        <p>{{ __('Map information is not available at the moment.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Mapbox API açarı və filial məlumatları PHP-dən gəlibsə JavaScript-i işə sal --}}
    @if(!empty($settings['mapbox_api_key']) && !empty($settings['mapbox_latitude']) && !empty($settings['mapbox_longitude']))
        <script src='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mapboxApiKey = '{{ $settings['mapbox_api_key'] }}';
                const mapboxStyleUrl = '{{ $settings['mapbox_style_url'] ?? 'mapbox://styles/mapbox/streets-v12' }}';
                const locations = @json($locations);

                console.log("Contact Page Mapbox API Key:", mapboxApiKey);
                console.log("Contact Page Locations Data:", JSON.stringify(locations, null, 2));

                if (!mapboxApiKey) {
                    console.error('Mapbox API Key is not provided.');
                    const mapDiv = document.getElementById('mapbox-map');
                    if(mapDiv) mapDiv.innerHTML = '<p style="color:red; text-align:center; padding:20px;">Mapbox API Key is missing.</p>';
                    // "Get Directions" düyməsini gizlət
                    const directionsBtn = document.getElementById('get-directions-btn');
                    if(directionsBtn && directionsBtn.parentElement) directionsBtn.parentElement.style.display = 'none';
                    return;
                }

                mapboxgl.accessToken = mapboxApiKey;
                const mapElement = document.getElementById('mapbox-map');

                if (!mapElement) {
                    console.error('Map element with ID "mapbox-map" not found.');
                     // "Get Directions" düyməsini gizlət
                    const directionsBtn = document.getElementById('get-directions-btn');
                    if(directionsBtn && directionsBtn.parentElement) directionsBtn.parentElement.style.display = 'none';
                    return;
                }
                
                if (!locations || locations.length === 0) {
                    console.info('No locations to display on the map.');
                    mapElement.innerHTML = '<p style="text-align:center; padding:20px;">Göstəriləcək filial yoxdur.</p>';
                    const directionsBtn = document.getElementById('get-directions-btn');
                    if(directionsBtn && directionsBtn.parentElement) directionsBtn.parentElement.style.display = 'none';
                    return;
                }

                const bounds = new mapboxgl.LngLatBounds();
                locations.forEach(function(location) {
                    if (location.latitude && location.longitude) {
                        bounds.extend([location.longitude, location.latitude]);
                    }
                });

                let initialCenter = [49.8533, 40.3790]; // Default Baku
                let initialZoom = 6;
                let currentSelectedLocationForDirections = null; // For directions button

                if (locations.length > 0) {
                    if (locations.length === 1) {
                        initialCenter = [locations[0].longitude, locations[0].latitude];
                        initialZoom = 13;
                    } else if (!bounds.isEmpty()){
                        // bounds-dan mərkəz və zoom təyin etməyə ehtiyac yoxdur, map.fitBounds() bunu edəcək
                        // Amma ilkin mərkəz olaraq yenə də ilk filialı və ya bounds-ın mərkəzini götürə bilərik
                        initialCenter = bounds.getCenter().toArray();
                        // initialZoom hesablaması mürəkkəb ola bilər, fitBounds daha yaxşıdır
                    } 
                }
                
                const map = new mapboxgl.Map({
                    container: mapElement,
                    style: mapboxStyleUrl,
                    center: initialCenter, // İlkin mərkəz
                    zoom: initialZoom // İlkin zoom (əgər fitBounds istifadə edilmirsə)
                });

                map.addControl(new mapboxgl.NavigationControl());
                console.log("Map initialized. Processing locations for markers...");

                locations.forEach(function(location) {
                    if (location.latitude && location.longitude) {
                        console.log("Processing marker for:", location.name, "Coords:", location.longitude, location.latitude);

                        const popupContent = `
                            <div style="font-family: 'Montserrat', sans-serif; max-width: 250px;">
                                <h3 style="font-weight: bold; margin-bottom: 5px; color: #333;">${location.name}</h3>
                                ${location.address ? `<p style="font-size: 0.9em; margin-bottom: 3px; color: #555;">${location.address}</p>` : ''}
                                ${location.description ? `<p style="font-size: 0.85em; color: #777;">${location.description}</p>` : ''}
                            </div>
                        `;

                        const popup = new mapboxgl.Popup({ offset: 25 })
                            .setHTML(popupContent);
                        
                        popup.on('open', function() {
                            currentSelectedLocationForDirections = location;
                            updateDirectionsButton();
                        });

                        new mapboxgl.Marker() 
                            .setLngLat([location.longitude, location.latitude])
                            .setPopup(popup)
                    .addTo(map);
                        console.log("Marker ADDED for:", location.name);
                    } else {
                        console.warn("Skipping location due to missing coordinates:", location.name, JSON.stringify(location, null, 2));
                    }
                });
                
                console.log("Finished processing locations for markers.");

                const directionsBtn = document.getElementById('get-directions-btn');
                
                function updateDirectionsButton() {
                if (directionsBtn) {
                        let targetLocation = null;
                        if (currentSelectedLocationForDirections) {
                            targetLocation = currentSelectedLocationForDirections;
                        } else if (locations.length > 0) {
                            targetLocation = locations[0]; // Default to the first location if none is selected via popup
                        }

                        if (targetLocation && targetLocation.latitude && targetLocation.longitude) {
                            directionsBtn.href = `https://www.google.com/maps/dir/?api=1&destination=${targetLocation.latitude},${targetLocation.longitude}`;
                            if (directionsBtn.parentElement) {
                                directionsBtn.parentElement.style.display = 'inline-block'; // or 'block' depending on layout
                            }
                        } else {
                            if (directionsBtn.parentElement) {
                                directionsBtn.parentElement.style.display = 'none';
                            }
                        }
                    }
                }

                updateDirectionsButton(); // Initial setup of the button

                // Əgər birdən çox filial varsa və ya tək filial olsa da, xəritəni markerlərə uyğunlaşdır
                 if (!bounds.isEmpty()) {
                    map.fitBounds(bounds, {
                        padding: {top: 50, bottom:50, left: 50, right: 50},
                        maxZoom: 15 // Maksimum yaxınlaşma səviyyəsi
                    });
                }

                const observer = new ResizeObserver(() => {
                    if (map && mapElement.offsetParent !== null) {
                        map.resize();
                    }
                });
                observer.observe(mapElement);
            });
        </script>
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const mapDiv = document.getElementById('mapbox-map');
                const directionsBtn = document.getElementById('get-directions-btn');
                if (mapDiv) {
                    let message = '';
                    if (@json(empty($settings['mapbox_api_key']))) {
                        message = 'Mapbox API Key is missing or not configured.';
                        console.error(message);
                    } else if (@json(!isset($locations) || count($locations) === 0)) {
                        message = 'Göstəriləcək filial yoxdur.';
                        console.info(message);
                    }
                    if (message) mapDiv.innerHTML = `<p style="color:red; text-align:center; padding:20px;">${message}</p>`;
                }
                if(directionsBtn && directionsBtn.parentElement) directionsBtn.parentElement.style.display = 'none';
            });
        </script>
    @endif
@endpush 