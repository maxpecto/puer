@extends('layouts.app')

@section('title', __('Our Products') . ' - ' . ($settings['site_name'] ?? __('Chaai')))

@section('content')
    <div class="container mx-auto px-4 pt-24 pb-16">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-6 font-serif" style="color: var(--accent-color)">{{ $settings['products_page_title'] ?? __('Explore Our Teas') }}</h1>

        @if(!empty($settings['products_page_subtitle']))
            <p class="text-center text-lg mb-12 md:mb-16 max-w-2xl mx-auto" style="color: var(--text-color)">{{ $settings['products_page_subtitle'] }}</p>
        @endif

        <div id="toast-notification" class="fixed top-20 right-5 bg-green-500 text-white py-3 px-6 rounded-lg shadow-md text-sm z-50 hidden">
            <span id="toast-message"></span>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="group rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl border flex flex-col" style="background-color: var(--surface-color); border-color: var(--secondary-color);">
                        <a href="{{ route('products.show', $product->slug) }}" class="block aspect-w-1 aspect-h-1 w-full overflow-hidden">
                            @if($product->image_path)
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <img src="{{ $settings['default_product_image'] ? Storage::url($settings['default_product_image']) : 'https://via.placeholder.com/300x300.png?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @endif
                        </a>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold mb-2 min-h-[3em] overflow-hidden" style="color: var(--accent-color);">{{ $product->name }}</h3>
                            {{-- <p class="text-gray-600 text-sm mb-3 h-12 overflow-hidden">{{ Str::limit($product->description, 50) }}</p> --}}
                            <p class="text-xl font-bold mb-4 mt-auto" style="color: var(--primary-color);">₼{{ number_format($product->price, 2) }}</p>
                            <div class="mt-auto flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0 sm:space-x-2">
                                <a href="{{ route('products.show', $product->slug) }}" 
                                   class="w-full sm:w-auto text-center text-sm px-4 py-2.5 font-medium rounded-lg hover:opacity-80 transition duration-300 whitespace-nowrap"
                                   style="background-color: var(--button-secondary-bg-color); color: var(--button-secondary-text-color);">
                                    {{ __('View Details') }}
                                </a>
                                <button type="button" 
                                        data-product-id="{{ $product->id }}"
                                        class="add-to-cart-btn w-full sm:w-auto text-sm px-4 py-2.5 font-medium rounded-lg hover:opacity-80 transition duration-300 flex items-center justify-center whitespace-nowrap"
                                        style="background-color: var(--button-primary-bg-color); color: var(--button-primary-text-color);">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    {{ __('Add to Cart') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16">
                 @include('partials.cart-empty-svg') {{-- Bu SVG məhsul yoxdur SVG-si ilə dəyişdirilə bilər --}}
                <h3 class="mt-4 text-2xl font-semibold" style="color: var(--text-color);">{{ __('No Teas to Explore Yet') }}</h3>
                <p class="mt-2 text-lg" style="color: var(--text-color); opacity: 0.7;">{{ __('We\'re brewing up new products. Please check back soon!') }}</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const toastNotification = document.getElementById('toast-notification');
        const toastMessage = document.getElementById('toast-message');

        function showToast(message, isSuccess = true) {
            toastMessage.textContent = message;
            toastNotification.classList.remove('bg-green-500', 'bg-red-500', 'hidden');
            if (isSuccess) {
                toastNotification.classList.add('bg-green-500');
            } else {
                toastNotification.classList.add('bg-red-500');
            }
            toastNotification.classList.remove('hidden');
            setTimeout(() => {
                toastNotification.classList.add('hidden');
            }, 3000);
        }

        function updateCartCounts(count) {
            const cartCountElements = [
                document.getElementById('header-cart-count'),
                document.getElementById('mobile-header-cart-count'),
                document.getElementById('mobile-menu-cart-count')
            ];
            cartCountElements.forEach(el => {
                if (el) {
                    el.textContent = count;
                    if (count > 0) {
                        el.style.display = 'inline-flex';
                    } else {
                        el.style.display = 'none';
                    }
                }
            });
        }

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;
                const originalButtonContent = this.innerHTML;
                this.innerHTML = `<svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Cəhd edilir...`;
                this.disabled = true;

                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ quantity: 1 })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        updateCartCounts(data.cartItemsCount);
                    } else {
                        showToast(data.message || '{{ __("Unable to add product to cart!") }}', false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('{{ __("An unexpected error occurred.") }}', false);
                })
                .finally(() => {
                    this.innerHTML = originalButtonContent;
                    this.disabled = false;
                });
            });
        });
    });
</script>
@endpush 