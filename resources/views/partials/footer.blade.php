<!-- Footer Content Start -->
<footer class="bg-footer pt-16 pb-8 mt-20" style="color: var(--footer-text-color, #C6F6D5) !important;">
    <style>
        footer .text-footer, footer .text-footer *:not(.hover\:text-footer-link-hover):not(a):not(svg):not(i) {
            color: var(--footer-text-color, #C6F6D5) !important;
        }
        footer .text-footer-secondary, footer .text-footer-secondary *:not(.hover\:text-footer-link-hover):not(a):not(svg):not(i) {
            color: var(--footer-secondary-text-color, #68D391) !important;
        }
        footer a,
        footer a svg,
        footer a i {
            color: var(--footer-text-color, #C6F6D5);
            transition: color 0.2s;
        }
        footer a:hover,
        footer a:hover svg,
        footer a:hover i,
        .hover\:text-footer-link-hover:hover {
            color: var(--footer-link-hover-color, #fff) !important;
        }
        footer strong {
            color: inherit;
            font-weight: bold;
        }
    </style>
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- About/Logo -->
            <div>
                @if(!empty($settings['site_logo_footer']))
                    <img src="{{ Storage::url($settings['site_logo_footer']) }}" alt="{{ $settings['site_name'] ?? __('Chaai') }}" class="h-12 mb-4">
                @else
                    <h3 class="text-2xl font-serif font-semibold mb-4" style="color: var(--footer-text-color, #C6F6D5) !important;">{{ $settings['site_name'] ?? __('Chaai') }}</h3>
                @endif
                <p class="text-sm leading-relaxed text-footer" style="color: var(--footer-text-color, #C6F6D5) !important;">
                    {{ $settings['footer_address'] ?? __('123 Tea Street, Flavor Town, CA 90210') }}
                </p>
                 <div class="mt-2 text-sm text-footer" style="color: var(--footer-text-color, #C6F6D5) !important;">
                    <p><strong>{{ __('Phone:') }}</strong> {{ $settings['footer_phone'] ?? __('+1 234 567 890') }}</p>
                    <p><strong>{{ __('Email:') }}</strong> {{ $settings['footer_email'] ?? __('info@chaai.com') }}</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4" style="color: var(--footer-text-color, #C6F6D5) !important;">{{ __('Keçidlər') }}</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-footer-link-hover">{{ __('Əsas Səhifə') }}</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-footer-link-hover">{{ __('Məhsullar') }}</a></li>
                    <li><a href="{{ route('about.index') }}" class="hover:text-footer-link-hover">{{ __('Haqqımızda') }}</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-footer-link-hover">{{ __('Əlaqə') }}</a></li>
                </ul>
            </div>

            <!-- Working Hours -->
            <div>
                <h4 class="text-lg font-semibold mb-4" style="color: var(--footer-text-color, #C6F6D5) !important;">{{ __('Working Hours') }}</h4>
                <p class="text-sm text-footer" style="color: var(--footer-text-color, #C6F6D5) !important;">{{ $settings['working_hours_weekdays'] ?? __('Mon - Fri: 09:00 - 18:00') }}</p>
                <p class="text-sm text-footer mb-2" style="color: var(--footer-text-color, #C6F6D5) !important;">{{ $settings['working_hours_weekend'] ?? __('Sat - Sun: 10:00 - 16:00') }}</p>
                @if(!empty($settings['whatsapp_number']))
                    <p class="text-sm text-footer" style="color: var(--footer-text-color, #C6F6D5) !important;">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) }}" target="_blank" class="hover:text-footer-link-hover inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.965 2.035a.5.5 0 00-.707 0L15.036 4.257a13.513 13.513 0 00-10.072 10.072L2.035 16.965a.5.5 0 000 .707l.707.707a.5.5 0 00.707 0l2.928-2.928a1.002 1.002 0 011.415 0l1.09 1.09c.368.368.965.368 1.333 0l4.866-4.866c.368-.368.368-.965 0-1.333l-1.09-1.09a1.002 1.002 0 010-1.415l2.928-2.928a.5.5 0 000-.707l-.707-.707zM8.755 8.043a.5.5 0 00-.707 0L6.013 10.078a.5.5 0 000 .707l2.035 2.035a.5.5 0 00.707 0l2.035-2.035a.5.5 0 000-.707L8.755 8.043zM12 5.75a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z"></path></svg>
                            <span>{{ __('WhatsApp:') }} {{ $settings['whatsapp_number'] }}</span>
                        </a>
                    </p>
                @endif
            </div>

            <!-- Social Media -->
            <div>
                <h4 class="text-lg font-semibold mb-4" style="color: var(--footer-text-color, #C6F6D5) !important;">{{ __('Follow Us') }}</h4>
                <div class="flex space-x-3" style="color: var(--footer-text-color, #C6F6D5) !important;">
                    @if(!empty($settings['facebook_url']))<a href="{{ $settings['facebook_url'] }}" target="_blank" class="hover:text-footer-link-hover"><svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor"><path d="M12 2.04c-5.5 0-10 4.49-10 10s4.5 10 10 10 10-4.49 10-10S17.5 2.04 12 2.04zm1.01 15.42h-2.02v-5.7H10v-2.01h1.01v-1.5c0-1.21.54-1.89 1.88-1.89h1.53v2.01h-1.01c-.23 0-.29.15-.29.4v1.02h1.54l-.22 2.01H13v5.66z"></path></svg></a>@endif
                    @if(!empty($settings['instagram_url']))<a href="{{ $settings['instagram_url'] }}" target="_blank" class="hover:text-footer-link-hover"><svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor"><path d="M12 2.04c-5.5 0-10 4.49-10 10s4.5 10 10 10 10-4.49 10-10S17.5 2.04 12 2.04zm4.22 7.14c.11.62.17 1.26.17 1.92 0 3.54-2.86 6.4-6.4 6.4s-6.4-2.86-6.4-6.4c0-.66.06-1.29.17-1.92H5.5v6.49c0 .55.45 1 1 1h8.01c.55 0 1-.45 1-1V9.18h-1.29zm-4.38-3.63c1.04 0 1.88.84 1.88 1.88s-.84 1.88-1.88 1.88-1.88-.84-1.88-1.88.84-1.88 1.88-1.88zm6.35 0c.39 0 .7.31.7.7s-.31.7-.7.7-.7-.31-.7-.7.31-.7.7-.7z"></path></svg></a>@endif
                    @if(!empty($settings['twitter_url']))<a href="{{ $settings['twitter_url'] }}" target="_blank" class="hover:text-footer-link-hover"><svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor"><path d="M12 2.04c-5.5 0-10 4.49-10 10s4.5 10 10 10 10-4.49 10-10S17.5 2.04 12 2.04zm4.84 7.7c-.02.15-.02.31-.02.46 0 4.7-3.58 10.11-10.11 10.11-2.01 0-3.88-.59-5.46-1.6.28.03.56.05.85.05 1.67 0 3.21-.57 4.43-1.53-1.56-.03-2.87-1.06-3.33-2.48.22.04.44.06.67.06.32 0 .63-.04.93-.12-1.63-.33-2.86-1.77-2.86-3.52V11c.48.27 1.03.43 1.61.44-.95-.64-1.58-1.73-1.58-2.96 0-.65.17-1.26.48-1.81 1.75 2.14 4.36 3.55 7.29 3.7-.06-.27-.09-.54-.09-.82 0-1.98 1.6-3.58 3.58-3.58 1.03 0 1.96.43 2.61 1.13.81-.16 1.58-.45 2.26-.86-.27.83-.83 1.54-1.57 1.98.72-.09 1.41-.28 2.04-.56-.49.72-1.09 1.35-1.79 1.85z"></path></svg></a>@endif
                    @if(!empty($settings['pinterest_url']))<a href="{{ $settings['pinterest_url'] }}" target="_blank" class="hover:text-footer-link-hover"><svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor"><path d="M12 2.04c-5.5 0-10 4.49-10 10s4.5 10 10 10 10-4.49 10-10S17.5 2.04 12 2.04zm-.68 15.05c-1.46 0-2.32-1.03-2.32-2.35 0-.8.34-1.61.9-2.29.28-.34.44-.63.44-1.02 0-.6-.33-1.04-.95-1.04-.75 0-1.31.69-1.31 1.57 0 .48-.07.84-.07 1.21 0 .16-.02.33-.05.5h-1.49c.03-.31.05-.64.05-1 0-1.11-.39-2.62-1.74-3.25-.5-.23-1.08-.12-1.48.3-.48.5-.58 1.2-.29 1.9.44 1.05 1.54 2.9 1.54 3.95 0 .63-.23 1.13-.66 1.5-.48.42-1.1.63-1.8.63-.93 0-2.2-.64-2.66-2.19-.1-.39-.16-.81-.16-1.26 0-2.14 1.25-4.08 3.93-4.08 1.95 0 3.3 1.12 3.3 2.91 0 .71-.25 1.49-.7 2.05-.05.06-.09.13-.12.21-.02.05-.02.1-.02.16 0 .23.12.41.31.51.25.13.54.05.78-.15.53-.45 1.08-1.5 1.08-2.34 0-1.39-1.03-2.48-2.41-2.48s-2.41 1.09-2.41 2.48c0 .13.01.25.03.38h1.44c-.02-.12-.03-.24-.03-.38 0-.74.56-1.33 1.33-1.33s1.33.59 1.33 1.33c0 .38-.11.75-.4 1.18-.41.62-.66 1.33-.66 2.12 0 1.91 1.34 3.49 3.42 3.49 1.01 0 1.87-.34 2.52-.98.59-.58.93-1.38.93-2.31 0-.1-.01-.2-.02-.3h-1.45c.01.09.02.19.02.29 0 .48-.16.9-.45 1.21-.33.35-.76.55-1.24.55z"></path></svg></a>@endif
                    @if(!empty($settings['linkedin_url']))<a href="{{ $settings['linkedin_url'] }}" target="_blank" class="hover:text-footer-link-hover"><i class="fab fa-linkedin-in text-xl"></i></a>@endif
                    @if(!empty($settings['youtube_url']))<a href="{{ $settings['youtube_url'] }}" target="_blank" class="hover:text-footer-link-hover"><i class="fab fa-youtube text-xl"></i></a>@endif
                </div>
            </div>

        </div>
        <div class="text-center text-sm border-t border-footer pt-8" style="color: var(--footer-text-color, #C6F6D5) !important;">
            <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? __('Chaai') }}.{{ __(' All Rights Reserved.') }}</p>
        </div>
        <div class="text-center mt-2 text-sm" style="color:rgb(34, 78, 26);">
            # <a href="https://onuroid.site" target="_blank" style="color:rgb(34, 78, 26); text-decoration: underline;">Onur</a>
        </div>
    </div>
</footer>
<!-- Footer Content End --> 