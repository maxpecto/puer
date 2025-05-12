@extends('layouts.app')

@section('title', $product->name . ' - ' . ($settings['site_name'] ?? __('Chaai')))

@section('content')
    <div class="container mx-auto px-4 py-24 md:py-28" style="background-color: var(--background-color);">
        <div id="toast-notification" class="fixed top-20 right-5 py-3 px-6 rounded-lg shadow-md text-sm z-50 hidden" style="background-color: var(--button-primary-bg-color); color: var(--button-primary-text-color);">
            <span id="toast-message"></span>
        </div>

        <div class="shadow-xl rounded-lg overflow-hidden lg:flex" style="background-color: var(--surface-color);">
            <div class="lg:w-1/2">
                @if($product->image_path)
                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-auto md:h-[500px] lg:h-full object-cover">
                @else
                    <img src="{{ $settings['default_product_image'] ? Storage::url($settings['default_product_image']) : 'https://via.placeholder.com/600x600.png?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-auto md:h-[500px] lg:h-full object-cover">
                @endif
            </div>
            <div class="lg:w-1/2 p-6 md:p-10 lg:p-12 flex flex-col">
                <h1 class="text-3xl lg:text-4xl font-bold mb-3 font-serif" style="color: var(--accent-color);">{{ $product->name }}</h1>
                
                <div class="text-2xl lg:text-3xl font-semibold mb-5" style="color: var(--primary-color);">
                    ₼{{ number_format($product->price, 2) }}
                </div>
                
                <div class="prose prose-base lg:prose-lg mb-6 leading-relaxed" style="color: var(--text-color);">
                    {!! $product->description !!}
                </div>

                <div class="mt-auto pt-6 border-t" style="border-color: var(--secondary-color);">
                    <div class="flex items-center mb-5">
                        <label for="quantity-{{$product->id}}" class="mr-3 font-semibold" style="color: var(--text-color);">{{ __('Quantity') }}:</label>
                        <input type="number" id="quantity-{{$product->id}}" name="quantity" value="1" min="1" class="w-24 p-2 border rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 text-center" style="color: var(--text-color); background-color: var(--surface-color); border-color: var(--secondary-color);">
                    </div>
                    <button type="button" 
                            id="add-to-cart-btn-show"
                            data-product-id="{{ $product->id }}"
                            data-quantity-input="quantity-{{$product->id}}"
                            class="w-full font-semibold px-8 py-3 rounded-lg transition duration-300 text-lg flex items-center justify-center"
                            style="background-color: var(--button-primary-bg-color); color: var(--button-primary-text-color);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        {{ __('Add to Cart') }}
                    </button>
                </div>

                <div class="mt-8 text-sm" style="color: var(--text-color); opacity: 0.7;">
                    @if($product->category)
                    <p><span class="font-semibold" style="color: var(--accent-color);">{{ __('Category:') }}</span> 
                        <a href="#" style="color: var(--primary-color);">{{ $product->category->name }}</a>
                    </p>
                    @else
                    <p><span class="font-semibold" style="color: var(--accent-color);">{{ __('Category:') }}</span> {{ __('Uncategorized') }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Related Products Section (Optional) --}}
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-8 font-serif" style="color: var(--accent-color);">{{ __('You Might Also Like') }}</h2>
            {{-- Placeholder for related products --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                {{-- Example of how related products might be looped --}}
                {{-- @foreach($relatedProducts as $relatedProduct) --}}
                {{--     @include('partials.product-card', ['product' => $relatedProduct]) --}}
                {{-- @endforeach --}}
                 <p style="color: var(--text-color); opacity: 0.7;" class="col-span-full">{{ __('Related products will be shown here.') }}</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButton = document.getElementById('add-to-cart-btn-show');
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

        if (addToCartButton) {
            addToCartButton.addEventListener('click', function () {
                const productId = this.dataset.productId;
                const quantityInputId = this.dataset.quantityInput;
                const quantity = document.getElementById(quantityInputId).value;
                const originalButtonContent = this.innerHTML;
                
                this.innerHTML = `<svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> {{ __("Processing...") }}`;
                this.disabled = true;

                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ quantity: quantity })
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
        }
    });
</script>
@endpush 