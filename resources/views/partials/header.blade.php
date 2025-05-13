<!-- Header Content Start -->
<header x-data="{ open: false }" 
        x-init="console.log('Alpine.js initialized')"
        @keydown.escape.window="open = false"
        class="py-6 absolute top-0 left-0 w-full z-50 header-styling" 
        :style="'background-color:' + (open ? 'var(--mobile-menu-bg-color)' : 'var(--header-bg-color)')">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold font-serif" :style="'color: var(--header-text-color)'">
            @if(!empty($settings['site_logo_header']))
                <img src="{{ Storage::url($settings['site_logo_header']) }}" alt="{{ $settings['site_name'] ?? __('Chaai') }}" class="h-10">
            @else
                {{ $settings['site_name'] ?? __('Chaai') }}
            @endif
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center">
            <ul class="flex space-x-6 items-center text-sm">
                @if(isset($mainMenu) && $mainMenu && $mainMenu->items->count() > 0)
                    @foreach($mainMenu->items as $item)
                        <li>
                            <a href="{{ url($item->url) }}" 
                               target="{{ $item->target ?? '_self' }}" 
                               class="transition-colors text-header-link hover:text-header-link-hover @if(request()->is(ltrim($item->url, '/'))) text-header-link-active @endif">
                                @if($item->icon) <i class="{{ $item->icon }} mr-1"></i> @endif
                                {{ $item->title }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <li><a href="{{ route('home') }}" class="transition-colors text-header-link hover:text-header-link-hover @if(request()->routeIs('home')) text-header-link-active @endif">{{ __('Əsas Səhifə') }}</a></li>
                    <li><a href="{{ route('products.index') }}" class="transition-colors text-header-link hover:text-header-link-hover @if(request()->routeIs('products.index') || request()->routeIs('products.show')) text-header-link-active @endif">{{ __('Məhsullar') }}</a></li>
                    <li><a href="{{ route('about.index') }}" class="transition-colors text-header-link hover:text-header-link-hover @if(request()->routeIs('about.index')) text-header-link-active @endif">{{ __('Haqqımızda') }}</a></li>
                    <li><a href="{{ route('contact.index') }}" class="transition-colors text-header-link hover:text-header-link-hover @if(request()->routeIs('contact.index')) text-header-link-active @endif">{{ __('Əlaqə') }}</a></li>
                @endif
            </ul>
        </nav>

        <!-- Right Side Icons/Links - Desktop -->
        <div class="hidden lg:flex items-center space-x-4">
            <a href="#" class="text-header-icon hover:text-header-icon-hover"><i class="fas fa-search"></i></a>
            <a href="{{ route('cart.index') }}" class="text-header-icon hover:text-header-icon-hover flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <span class="ml-1">{{ __('Cart') }}</span> 
                @if(isset($cartItemsCount) && $cartItemsCount > 0)
                    <span id="header-cart-count" class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none rounded-full bg-cart-badge text-cart-badge">{{ $cartItemsCount }}</span>
                @else
                    <span id="header-cart-count" class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none rounded-full bg-cart-badge text-cart-badge" style="display: none;">0</span>
                @endif
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden flex items-center">
            <a href="{{ route('cart.index') }}" class="text-mobile-menu-button hover:text-mobile-menu-button-hover mr-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                @if(isset($cartItemsCount) && $cartItemsCount > 0)
                    <span id="mobile-header-cart-count" class="ml-1 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold leading-none rounded-full bg-cart-badge text-cart-badge">{{ $cartItemsCount }}</span>
                @else
                    <span id="mobile-header-cart-count" class="ml-1 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold leading-none rounded-full bg-cart-badge text-cart-badge" style="display: none;">0</span>
                @endif
            </a>
            <button @click="open = !open" 
                    @click.away="open = false"
                    class="text-mobile-menu-button hover:text-mobile-menu-button-hover focus:outline-none flex items-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span x-show="!open" class="ml-2">{{ __('Menu') }}</span>
                <span x-show="open" style="display: none;" class="ml-2">{{ __('Close') }}</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="lg:hidden shadow-lg absolute top-full left-0 w-full bg-mobile-menu">
        <ul class="flex flex-col py-2">
            @if(isset($mainMenu) && $mainMenu && $mainMenu->items->count() > 0)
                @foreach($mainMenu->items as $item)
                    <li>
                        <a href="{{ url($item->url) }}" 
                           target="{{ $item->target ?? '_self' }}" 
                           class="block px-4 py-2 text-sm transition-colors text-mobile-menu-link hover:bg-mobile-menu-link-hover hover:text-mobile-menu-link-hover-text @if(request()->is(ltrim($item->url, '/'))) text-mobile-menu-link-active @endif">
                            @if($item->icon) <i class="{{ $item->icon }} mr-1"></i> @endif
                            {{ $item->title }}
                        </a>
                    </li>
                @endforeach
            @else
                <li><a href="{{ route('home') }}" class="block px-4 py-2 text-sm transition-colors text-mobile-menu-link hover:bg-mobile-menu-link-hover hover:text-mobile-menu-link-hover-text @if(request()->routeIs('home')) text-mobile-menu-link-active @endif">{{ __('Əsas Səhifə') }}</a></li>
                <li><a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm transition-colors text-mobile-menu-link hover:bg-mobile-menu-link-hover hover:text-mobile-menu-link-hover-text @if(request()->routeIs('products.index') || request()->routeIs('products.show')) text-mobile-menu-link-active @endif">{{ __('Məhsullar') }}</a></li>
                <li><a href="{{ route('about.index') }}" class="block px-4 py-2 text-sm transition-colors text-mobile-menu-link hover:bg-mobile-menu-link-hover hover:text-mobile-menu-link-hover-text @if(request()->routeIs('about.index')) text-mobile-menu-link-active @endif">{{ __('Haqqımızda') }}</a></li>
                <li><a href="{{ route('contact.index') }}" class="block px-4 py-2 text-sm transition-colors text-mobile-menu-link hover:bg-mobile-menu-link-hover hover:text-mobile-menu-link-hover-text @if(request()->routeIs('contact.index')) text-mobile-menu-link-active @endif">{{ __('Əlaqə') }}</a></li>
            @endif
            <li>
                <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm transition-colors text-mobile-menu-link hover:bg-mobile-menu-link-hover hover:text-mobile-menu-link-hover-text flex items-center @if(request()->routeIs('cart.index')) text-mobile-menu-link-active @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <span>{{ __('Cart') }}</span>
                    @if(isset($cartItemsCount) && $cartItemsCount > 0)
                        <span id="mobile-menu-cart-count" class="ml-2 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none rounded-full bg-cart-badge text-cart-badge">{{ $cartItemsCount }}</span>
                    @else
                        <span id="mobile-menu-cart-count" class="ml-2 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none rounded-full bg-cart-badge text-cart-badge" style="display: none;">0</span>
                    @endif
                </a>
            </li>
            <li class="border-t mt-2 pt-2" :style="'border-color: var(--secondary-color)'">
                 <a href="#" class="block px-4 py-2 text-sm transition-colors text-mobile-menu-link hover:bg-mobile-menu-link-hover hover:text-mobile-menu-link-hover-text"><i class="fas fa-search mr-1"></i> Axtarış</a>
            </li>
        </ul>
    </div>
</header>
<!-- Header Content End --> 