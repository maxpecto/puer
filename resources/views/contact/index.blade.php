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
            color: var(--contact-icon-color, var(--accent-color, #34D399));
        }
        .contact-section-bg {
            background: var(--contact-section-bg, linear-gradient(to bottom right, var(--contact-bg-from, #f0fdf4), var(--contact-bg-via, #f7fee7), var(--contact-bg-to, #ecfdf5)));
        }
        .contact-title {
            color: var(--contact-title-color, var(--header-link-color, #15803d));
        }
        .contact-subtitle {
            color: var(--contact-subtitle-color, var(--secondary-text-color, #4b5563));
        }
        .contact-box-bg {
            background: var(--contact-box-bg, #fff);
        }
        .contact-box-shadow {
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.1), 0 4px 6px -2px rgba(16, 185, 129, 0.05);
        }
        .contact-label {
            color: var(--contact-label-color, var(--text-color, #374151));
        }
        .contact-input {
            border-color: var(--contact-input-border, #d1d5db);
        }
        .contact-input:focus {
            border-color: var(--primary-color, #22c55e);
            box-shadow: 0 0 0 1px var(--primary-color, #22c55e);
        }
        .contact-btn {
            background: var(--contact-btn-bg, var(--primary-color, #22c55e));
            color: var(--contact-btn-text, #fff);
        }
        .contact-btn:hover {
            background: var(--contact-btn-bg-hover, var(--primary-color-dark, #16a34a));
        }
        .contact-alert-success {
            background: var(--contact-success-bg, #dcfce7);
            border-left: 4px solid var(--contact-success-border, #22c55e);
            color: var(--contact-success-text, #166534);
        }
        .contact-alert-error {
            background: var(--contact-error-bg, #fee2e2);
            border-left: 4px solid var(--contact-error-border, #ef4444);
            color: var(--contact-error-text, #991b1b);
        }
        .contact-social {
            color: var(--contact-social-color, #6b7280);
            background: var(--contact-social-bg, #f3f4f6);
        }
        .contact-social:hover {
            color: var(--contact-social-hover, var(--accent-color, #15803d));
            background: var(--contact-social-bg-hover, #d1fae5);
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
                        <h2 class="text-2xl md:text-3xl font-semibold contact-title mb-6 font-serif">{{ __('Contact Details') }}</h2>
                        <div class="space-y-5" style="color: var(--contact-info-text, var(--text-color, #374151));">
                            @if(!empty($settings['contact_address']) || !empty($settings['footer_address']))
                            <div class="flex items-start">
                                <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color, var(--accent-color, #15803d));">{{ __('Address:') }}</h3>
                                    <p style="color: var(--contact-info-secondary, var(--secondary-text-color, #4b5563));">{{ $settings['contact_address'] ?? ($settings['footer_address'] ?? __('123 Tea Street, Flavor Town, CA 90210')) }}</p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['contact_phone']) || !empty($settings['footer_phone']))
                            <div class="flex items-start">
                                <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.308 1.155a11.034 11.034 0 005.656 5.656l1.155-2.308a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color, var(--accent-color, #15803d));">{{ __('Phone:') }}</h3>
                                    <p><a href="tel:{{ $settings['contact_phone'] ?? ($settings['footer_phone'] ?? '+1234567890') }}" style="color: var(--contact-info-secondary, var(--secondary-text-color, #4b5563));" class="hover:underline">{{ $settings['contact_phone'] ?? ($settings['footer_phone'] ?? __('+1 234 567 890')) }}</a></p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['contact_email']) || !empty($settings['footer_email']))
                            <div class="flex items-start">
                                 <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color, var(--accent-color, #15803d));">{{ __('Email:') }}</h3>
                                    <p><a href="mailto:{{ $settings['contact_email'] ?? ($settings['footer_email'] ?? 'info@chaai.com') }}" style="color: var(--contact-info-secondary, var(--secondary-text-color, #4b5563));" class="hover:underline">{{ $settings['contact_email'] ?? ($settings['footer_email'] ?? __('info@chaai.com')) }}</a></p>
                                </div>
                            </div>
                            @endif
                            @if(!empty($settings['working_hours_weekdays']) || !empty($settings['working_hours_weekend']))
                            <div class="flex items-start">
                                <svg class="contact-icon flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <div>
                                    <h3 class="font-semibold text-lg" style="color: var(--contact-label-color, var(--accent-color, #15803d));">{{ __('Working Hours:') }}</h3>
                                    @if(!empty($settings['working_hours_weekdays'])) <p style="color: var(--contact-info-secondary, var(--secondary-text-color, #4b5563));">{{ $settings['working_hours_weekdays'] }}</p> @endif
                                    @if(!empty($settings['working_hours_weekend'])) <p style="color: var(--contact-info-secondary, var(--secondary-text-color, #4b5563));">{{ $settings['working_hours_weekend'] }}</p> @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Social Media Links --}}
                    @if(!empty($settings['facebook_url']) || !empty($settings['instagram_url']) || !empty($settings['twitter_url']) || !empty($settings['linkedin_url']) || !empty($settings['whatsapp_number']))
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="font-semibold text-xl" style="color: var(--contact-label-color, var(--accent-color, #15803d));">{{ __('Follow Us & Chat:') }}</h3>
                        <div class="flex flex-wrap gap-4">
                            @if(!empty($settings['facebook_url']))
                                <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social transition-colors duration-200 p-2 rounded-full" aria-label="{{ __('Facebook') }}">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.732 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"></path></svg>
                                </a>
                            @endif
                            @if(!empty($settings['instagram_url']))
                                <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="contact-social transition-colors duration-200 p-2 rounded-full" aria-label="{{ __('Instagram') }}">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.272.058 2.164.248 2.948.566.784.318 1.458.746 2.068 1.356s1.038 1.284 1.356 2.068c.318.784.508 1.676.566 2.948.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.058 1.272-.248 2.164-.566 2.948-.318.784-.746 1.458-1.356 2.068s-1.284 1.038-2.068 1.356c-.784.318-1.676.508-2.948.566-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.272-.058-2.164-.248-2.948-.566-.784-.318-1.458-.746-2.068-1.356s-1.038-1.284-1.356-2.068c-.318-.784-.508-1.676-.566-2.948-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.058-1.272.248-2.164.566-2.948.318-.784.746-1.458 1.356-2.068s1.284-1.038 2.068-1.356c.784-.318 1.676-.508 2.948-.566C8.416 2.175 8.796 2.163 12 2.163zm0-1.905C8.72 0 8.312.012 7.05.07c-1.356.06-2.42.25-3.352.59C2.77 1.015 1.944 1.514 1.248 2.21s-.78 1.283-1.124 2.214C.06 5.49 0 6.553 0 7.908v8.184c0 1.356.06 2.42.124 3.352.344.93.844 1.757 1.54 2.452s1.178.882 2.112 1.226c.93.34 1.997.53 3.352.59 1.262.058 1.67.07 4.922.07s3.66-.012 4.922-.07c1.356-.06 2.42-.25 3.352-.59.93-.344 1.757-.844 2.452-1.54s.882-1.178 1.226-2.112c.34-.93.53-1.997.59-3.352.058-1.262.07-1.67.07-4.922V7.908c0-1.356-.06-2.42-.124-3.352-.344-.93-.844-1.757-1.54-2.452S20.508.78 19.574.436c-.93-.34-1.997-.53-3.352-.59C14.964.012 14.556 0 11.294 0H12zm0 5.816a6.062 6.062 0 100 12.124 6.062 6.062 0 000-12.124zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100-2.88 1.44 1.44 0 000 2.88z"></path></svg>
                                </a>
                            @endif
                            {{-- Add other social media icons similarly --}}
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
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium contact-label mb-1">{{ __('Email Address') }} <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" required>
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium contact-label mb-1">{{ __('Phone Number') }} ({{ __('Optional') }})</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium contact-label mb-1">{{ __('Subject') }}</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium contact-label mb-1">{{ __('Message') }} <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="5" class="mt-1 block w-full px-4 py-3 border contact-input rounded-md shadow-sm sm:text-sm transition-colors" required>{{ old('message') }}</textarea>
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
    @if(!empty($settings['mapbox_api_key']) && !empty($settings['mapbox_latitude']) && !empty($settings['mapbox_longitude']))
        <script src='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                mapboxgl.accessToken = '{{ $settings['mapbox_api_key'] }}';
                const map = new mapboxgl.Map({
                    container: 'mapbox-map',
                    style: '{{ $settings['mapbox_style_url'] ?? 'mapbox://styles/mapbox/streets-v11' }}',
                    center: [parseFloat('{{ $settings['mapbox_longitude'] }}'), parseFloat('{{ $settings['mapbox_latitude'] }}')],
                    zoom: parseInt('{{ $settings['mapbox_zoom_level'] ?? 10 }}')
                });

                map.addControl(new mapboxgl.NavigationControl(), 'top-right');
                map.addControl(new mapboxgl.FullscreenControl(), 'top-right');

                const marker = new mapboxgl.Marker({
                        color: "#10B981", // Tailwind green-500
                        draggable: false
                    }).setLngLat([parseFloat('{{ $settings['mapbox_longitude'] }}'), parseFloat('{{ $settings['mapbox_latitude'] }}')])
                    .setPopup(new mapboxgl.Popup({offset: 25}).setHTML(`<h6>{{ $settings['site_name'] ?? __('Our Location') }}</h6><p>{{ $settings['contact_address'] ?? ($settings['footer_address'] ?? '') }}</p>`))
                    .addTo(map);
                
                marker.togglePopup(); // Popup-ı başlanğıcda açıq göstər

                const directionsBtn = document.getElementById('get-directions-btn');
                if (directionsBtn) {
                    const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination={{ $settings['mapbox_latitude'] }},{{ $settings['mapbox_longitude'] }}`;
                    directionsBtn.href = googleMapsUrl;
                }
            });
        </script>
    @endif
@endpush 