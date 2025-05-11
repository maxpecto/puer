<!-- Header Content Start -->
<header class="py-6 bg-transparent absolute top-0 left-0 w-full z-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold font-serif text-gray-800">
            @if(!empty($settings['site_logo_header']))
                <img src="{{ Storage::url($settings['site_logo_header']) }}" alt="{{ $settings['site_name'] ?? __('Chaai') }}" class="h-10">
            @else
                {{ $settings['site_name'] ?? __('Chaai') }}
            @endif
        </a>

        <!-- Navigation -->
        <nav>
            <ul class="flex space-x-6 items-center text-sm text-gray-700">
                @if(isset($mainMenu) && $mainMenu && $mainMenu->items->count() > 0)
                    @foreach($mainMenu->items as $item)
                        <li>
                            <a href="{{ url($item->url) }}" 
                               target="{{ $item->target ?? '_self' }}" 
                               class="hover:text-green-600 transition-colors @if(request()->is(ltrim($item->url, '/'))) text-green-600 font-semibold @endif">
                                @if($item->icon) <i class="{{ $item->icon }} mr-1"></i> @endif
                                {{ $item->title }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <li><a href="{{ route('home') }}" class="hover:text-green-600 transition-colors @if(request()->routeIs('home')) text-green-600 font-semibold @endif">{{ __('Ana Sayfa') }}</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-green-600 transition-colors @if(request()->routeIs('products.index') || request()->routeIs('products.show')) text-green-600 font-semibold @endif">{{ __('Ürünler') }}</a></li>
                    <li><a href="#offers" class="hover:text-green-600 transition-colors">{{ __('Teklifler') }}</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-green-600 transition-colors @if(request()->routeIs('contact.index')) text-green-600 font-semibold @endif">{{ __('İletişim') }}</a></li>
                @endif
            </ul>
        </nav>

        <!-- Right Side Icons/Links -->
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-green-600"><i class="fas fa-search"></i></a>
            <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-green-600 flex items-center">
                <i class="fas fa-shopping-cart"></i>
                <span class="ml-1">{{ __('Cart') }}</span> 
                @if(isset($cartItemsCount) && $cartItemsCount > 0)
                    <span class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $cartItemsCount }}</span>
                @endif
            </a>
            @auth
                <a href="{{ route('filament.admin.auth.logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-gray-600 hover:text-green-600">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Yönetimden Çık') }}
                </a>
                <form id="logout-form" action="{{ route('filament.admin.auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('filament.admin.auth.login') }}" class="text-gray-600 hover:text-green-600"><i class="fas fa-user-circle"></i> {{ __('Giriş') }}</a>
            @endauth
        </div>
    </div>
</header>
<!-- Header Content End --> 