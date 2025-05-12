<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $settings['site_name'] ?? 'Chaai - Organic Tea Shop')</title>
    <link rel="icon" href="{{ !empty($settings['site_favicon']) ? Storage::url($settings['site_favicon']) : asset('favicon.ico') }}">

    <!-- Tailwind CSS (CDN for now, ideally should be compiled) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

    <!-- Alpine.js (Optional, for interactivity) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Fonts (Example: Google Fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--background-color, #F8F5F2);
            color: var(--text-color, #333);
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        :root {
            --primary-color: {{ $settings['primary_color'] ?? '#16a34a' }}; /* Defolt yeşil tonu */
            --secondary-color: {{ $settings['secondary_color'] ?? '#f1f5f9' }}; /* Defolt açık gri */
            --text-color: {{ $settings['text_color'] ?? '#1f2937' }}; /* text-gray-800 */
            --text-light-color: {{ $settings['text_light_color'] ?? '#f8fafc' }}; /* text-gray-50 */
            --background-color: {{ $settings['background_color'] ?? '#f3f4f6' }}; /* text-gray-100 */
            --surface-color: {{ $settings['surface_color'] ?? '#ffffff' }}; /* white */
            --accent-color: {{ $settings['accent_color'] ?? ($settings['primary_color'] ?? '#16a34a') }}; /* Vurgu için birincil renk */
            
            --header-bg-color: {{ $settings['header_bg_color'] ?? 'transparent' }};
            --header-text-color: {{ $settings['header_text_color'] ?? '#1f2937' }};
            --header-link-color: {{ $settings['header_link_color'] ?? ($settings['header_text_color'] ?? '#374151') }}; /* text-gray-700 */
            --header-link-hover-color: {{ $settings['header_link_hover_color'] ?? ($settings['accent_color'] ?? '#16a34a') }};
            --header-icon-color: {{ $settings['header_icon_color'] ?? '#4b5563' }}; /* text-gray-600 */
            --header-icon-hover-color: {{ $settings['header_icon_hover_color'] ?? ($settings['accent_color'] ?? '#16a34a') }};
            
            --mobile-menu-bg-color: {{ $settings['mobile_menu_bg_color'] ?? ($settings['surface_color'] ?? '#ffffff') }};
            --mobile-menu-link-color: {{ $settings['mobile_menu_link_color'] ?? ($settings['text_color'] ?? '#374151') }};
            --mobile-menu-link-hover-bg-color: {{ $settings['mobile_menu_link_hover_bg_color'] ?? '#f0fdf4' }}; /* green-50 gibi */
            --mobile-menu-link-hover-text-color: {{ $settings['mobile_menu_link_hover_text_color'] ?? ($settings['accent_color'] ?? '#16a34a') }};
            
            --cart-badge-bg-color: {{ $settings['cart_badge_bg_color'] ?? '#dc2626' }}; /* red-600 */
            --cart-badge-text-color: {{ $settings['cart_badge_text_color'] ?? '#fef2f2' }}; /* red-100 */

            --footer-bg-color: {{ $settings['footer_bg_color'] ?? '#22543D' }}; /* green-700 / 800 gibi koyu yeşil */
            --footer-text-color: {{ $settings['footer_text_color'] ?? '#C6F6D5' }}; /* green-50 / 100 gibi açık */
            --footer-secondary-text-color: {{ $settings['footer_secondary_text_color'] ?? '#68D391' }}; /* green-200 / 300 gibi */
            --footer-link-hover-color: {{ $settings['footer_link_hover_color'] ?? '#FFFFFF' }};
            --footer-border-color: {{ $settings['footer_border_color'] ?? '#2F855A' }}; /* green-600 gibi */
            
            --button-primary-bg-color: {{ $settings['button_primary_bg_color'] ?? ($settings['primary_color'] ?? '#16a34a') }};
            --button-primary-text-color: {{ $settings['button_primary_text_color'] ?? '#ffffff' }};
            --button-secondary-bg-color: {{ $settings['button_secondary_bg_color'] ?? '#4b5563' }}; /* text-gray-600 */
            --button-secondary-text-color: {{ $settings['button_secondary_text_color'] ?? '#ffffff' }};

            --contact-bg-color: {{ $settings['background_color'] ?? '#f9fafb' }};
            --contact-card-bg-color: {{ $settings['surface_color'] ?? '#ffffff' }};
            --contact-card-border-color: {{ $settings['footer_border_color'] ?? '#e5e7eb' }};
        }

        /* Dinamik Renkler için Yardımcı Sınıflar */
        .bg-header { background-color: var(--header-bg-color); }
        .text-header { color: var(--header-text-color); }
        .text-header-link { color: var(--header-link-color); }
        .text-header-link-active { color: var(--header-link-hover-color); font-weight: 600; } /* .font-semibold için */
        .hover\:text-header-link-hover:hover { color: var(--header-link-hover-color); }
        .text-header-icon { color: var(--header-icon-color); }
        .hover\:text-header-icon-hover:hover { color: var(--header-icon-hover-color); }

        .bg-mobile-menu { background-color: var(--mobile-menu-bg-color); }
        .text-mobile-menu-link { color: var(--mobile-menu-link-color); }
        .hover\:bg-mobile-menu-link-hover:hover { background-color: var(--mobile-menu-link-hover-bg-color); }
        .hover\:text-mobile-menu-link-hover-text:hover { color: var(--mobile-menu-link-hover-text-color); }
        .text-mobile-menu-link-active { color: var(--mobile-menu-link-hover-text-color); font-weight: 600; }

        .bg-cart-badge { background-color: var(--cart-badge-bg-color); }
        .text-cart-badge { color: var(--cart-badge-text-color); }

        /* Mobil menu buton renkleri (header transparan olduğunda önemlidir) */
        .text-mobile-menu-button { color: {{ $settings['mobile_menu_button_color'] ?? '#d1d5db' }}; } /* text-gray-300 veya header_text_color'a göre ayarlanabilir */
        .hover\:text-mobile-menu-button-hover:hover { color: {{ $settings['mobile_menu_button_hover_color'] ?? '#ffffff' }}; }

        .bg-footer { background-color: var(--footer-bg-color); }
        .text-footer { color: var(--footer-text-color); }
        .text-footer-secondary { color: var(--footer-secondary-text-color); }
        .text-footer-link { /* Varsayılan olarak text-footer'ı kullanır, sadece hover önemli */ }
        .hover\:text-footer-link-hover:hover { color: var(--footer-link-hover-color); }
        .border-footer { border-color: var(--footer-border-color); }
    </style>

    @stack('styles')
</head>
<body class="antialiased">
    
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html> 