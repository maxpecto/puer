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
                <div class="flex space-x-4 items-center" style="color: var(--footer-text-color, #C6F6D5) !important;">
                    @if(!empty($settings['facebook_url']))
                        <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="hover:text-footer-link-hover">
                            <svg role="img" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82V14.706h-3.454V11.08h3.454V8.413c0-3.426 2.1-5.278 5.165-5.278.926 0 1.852.068 2.78.168v3.24h-1.918c-1.664 0-1.987.79-1.987 1.951v2.553h3.587l-.467 3.626H16.57V24h6.105c.732 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="hover:text-footer-link-hover">
                            <svg role="img" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.784.305-1.457.717-2.123 1.383S.935 3.356.63 4.14C.333 4.905.132 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.26 2.148.558 2.913.306.783.718 1.457 1.384 2.123.667.666 1.34 1.078 2.124 1.383.766.296 1.636.498 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.783-.305 1.457-.718 2.123-1.383.666-.667 1.078-1.34 1.383-2.123.296-.765.498-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.148-.558-2.913-.305-.784-.718-1.457-1.383-2.124C21.065.935 20.393.522 19.63.218 18.867.06 17.997 0 16.947 0H12zm0 2.16c3.203 0 3.585.01 4.85.07 1.17.052 1.805.242 2.227.415.562.227.96.497 1.382.92s.693.82.92 1.382c.173.422.363 1.057.415 2.227.06 1.265.07 1.646.07 4.85s-.01 3.585-.07 4.85c-.052 1.17-.242 1.805-.415 2.227-.227.562-.497.96-.92 1.382s-.82.693-1.382.92c-.422.173-1.057.363-2.227.415-1.265.06-1.646.07-4.85.07s-3.585-.01-4.85-.07c-1.17-.052-1.805-.242-2.227-.415-.562-.227-.96-.497-1.382-.92s-.693-.82-.92-1.382c-.173-.422-.363-1.057-.415-2.227-.06-1.265-.07-1.646-.07-4.85s.01-3.585.07-4.85c.052-1.17.242-1.805.415-2.227.227-.562.497-.96.92-1.382s.82-.693 1.382-.92c.422-.173 1.057-.363 2.227-.415C8.415 2.17 8.797 2.16 12 2.16zm0 3.81c-3.403 0-6.162 2.76-6.162 6.162s2.76 6.162 6.162 6.162 6.162-2.76 6.162-6.162S15.403 5.97 12 5.97zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.44.645-1.44 1.44s.645 1.44 1.44 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['twitter_url']))
                        <a href="{{ $settings['twitter_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)" class="hover:text-footer-link-hover">
                            <svg role="img" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>X</title><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['pinterest_url']))
                        <a href="{{ $settings['pinterest_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Pinterest" class="hover:text-footer-link-hover">
                            <svg role="img" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Pinterest</title><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.198-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.377-.752-.377-1.845c0-1.713 1.002-2.981 2.245-2.981.994 0 1.469.746 1.469 1.641 0 .988-.631 2.477-.963 3.855-.273 1.117.564 2.032 1.666 2.032 2.007 0 3.559-2.119 3.559-5.188 0-2.633-1.914-4.515-4.748-4.515-3.261 0-5.174 2.436-5.174 4.934 0 .969.335 1.928.731 2.527.079.122.093.234.038.462-.172.777-.571 2.348-.722 2.938-.098.388-.405.47-.712.158-1.407-.943-2.205-2.981-2.205-4.662 0-3.788 2.755-7.262 7.928-7.262 4.159 0 7.392 2.967 7.392 6.922 0 4.131-2.625 7.468-6.248 7.468-1.211 0-2.348-.63-2.741-1.373 0 0-.598 2.282-.71 2.737-.228.906-.899 1.711-1.392 2.337.979.322 2.016.491 3.088.491 6.626 0 11.988-5.361 11.988-11.979C23.998 5.368 18.636 0 12.017 0Z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['linkedin_url']))
                        <a href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="hover:text-footer-link-hover">
                            <svg role="img" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>LinkedIn</title><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['youtube_url']))
                        <a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="hover:text-footer-link-hover">
                            <svg role="img" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>YouTube</title><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

        </div>
        <div class="text-center text-sm border-t border-footer pt-8" style="color: var(--footer-text-color, #C6F6D5) !important;">
            <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? __('Chaai') }}.{{ __(' All Rights Reserved.') }}</p>
        </div>
        <div class="text-center mt-2 text-sm">
             <a href="https://onuroid.site" target="_blank" style="display: inline-block; vertical-align: middle;">
                <img src="{{ asset('images/mylivesignature.png') }}" alt="Onur Signature" style="max-height: 60px; display: block;">
            </a>
        </div>
    </div>
</footer>
<!-- Footer Content End --> 