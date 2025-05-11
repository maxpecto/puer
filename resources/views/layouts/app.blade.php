<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-f_8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name ?? config('app.name', 'Laravel') }}</title>

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
            /* Base text color, background color from design if applicable */
            background-color: #F8F5F2; /* Assuming a light beige from design */
            color: #333; /* Placeholder, adjust based on design */
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        /* Add more global styles or component styles here if needed */
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