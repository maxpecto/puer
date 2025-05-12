@extends('layouts.app')

@section('title', __('Shopping Cart') . ' - ' . ($settings['site_name'] ?? __('Chaai')))

@section('content')
    <div class="container mx-auto px-4 py-24" style="background-color: var(--background-color); min-height: 60vh;">
        <h1 class="text-3xl font-bold text-center mb-10 font-serif" style="color: var(--accent-color);">{{ __('Shopping Cart') }}</h1>

        @if(session('success'))
            <div class="border px-4 py-3 rounded relative mb-6" style="background-color: var(--button-primary-bg-color); color: var(--button-primary-text-color); border-color: var(--button-primary-bg-color);">
                <strong class="font-bold">{{ __('Success!') }}</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="border px-4 py-3 rounded relative mb-6" style="background-color: #fee2e2; color: #b91c1c; border-color: #fca5a5;">
                <strong class="font-bold">{{ __('Error!') }}</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @php $totalPrice = 0; @endphp

        @if(count($cart) > 0)
            <div class="shadow-lg rounded-lg overflow-x-auto" style="background-color: var(--surface-color);">
                <table class="min-w-full divide-y" style="background-color: var(--surface-color);">
                    <thead style="background-color: var(--secondary-color);">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-color);">{{ __('Product') }}</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-color);">{{ __('Price') }}</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-color);">{{ __('Quantity') }}</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-color);">{{ __('Subtotal') }}</th>
                            <th scope="col" class="px-3 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color: var(--text-color);">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: var(--surface-color);">
                        @foreach($cart as $id => $details)
                            @php $totalPrice += $details['price'] * $details['quantity']; @endphp
                            <tr data-product-id="{{ $id }}">
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-14 w-14">
                                            @if($details['image_path'])
                                                <img class="h-14 w-14 rounded-md object-cover" src="{{ Storage::url($details['image_path']) }}" alt="{{ $details['name'] }}">
                                            @else
                                                <img class="h-14 w-14 rounded-md object-cover" src="https://via.placeholder.com/150?text={{ urlencode($details['name']) }}" alt="{{ $details['name'] }}">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium" style="color: var(--text-color);">{{ $details['name'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <div class="text-sm" style="color: var(--text-color);">₼{{ number_format($details['price'], 2) }}</div>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <button type="button" class="quantity-btn minus inline-flex items-center justify-center px-2 py-1 rounded-l border border-r-0" style="background-color: var(--secondary-color); color: var(--text-color);">-</button>
                                        <input type="number" name="quantity" min="1" value="{{ $details['quantity'] }}" class="w-14 text-center border-t border-b border-gray-300 rounded-none shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" style="color: var(--text-color); background-color: var(--surface-color); border-color: var(--secondary-color);" data-product-id="{{ $id }}">
                                        <button type="button" class="quantity-btn plus inline-flex items-center justify-center px-2 py-1 rounded-r border border-l-0" style="background-color: var(--secondary-color); color: var(--text-color);">+</button>
                                    </div>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap subtotal-cell">
                                    <div class="text-sm" style="color: var(--text-color);">₼{{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="transition-colors" style="color: var(--accent-color);" title="{{ __('Remove') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-10 flex flex-col items-end md:items-end">
                <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6" style="background-color: var(--surface-color);">
                    <div class="flex justify-between text-lg font-semibold" style="color: var(--text-color);">
                        <span>{{ __('Total:') }}</span>
                        <span class="cart-total-amount">₼{{ number_format($totalPrice, 2) }}</span>
                    </div>

                    @php
                        $whatsappNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '');
                        $message = __('Hello! I would like to order the following items:') . "\n\n";
                        foreach($cart as $id => $details) {
                            $message .= "*" . $details['name'] . "*\n";
                            $message .= __('Quantity:') . " " . $details['quantity'] . "\n";
                            $message .= __('Price:') . " ₼" . number_format($details['price'], 2) . "\n";
                            $message .= __('Subtotal:') . " ₼" . number_format($details['price'] * $details['quantity'], 2) . "\n\n";
                        }
                        $message .= "---------------------\n";
                        $message .= "*" . __('Total Amount:') . "* ₼" . number_format($totalPrice, 2);
                        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);
                    @endphp

                    @if(!empty($whatsappNumber))
                        <button id="whatsapp-order-btn" type="button" class="block w-full text-center mt-6 font-semibold py-3 px-6 rounded-lg text-md transition-colors" style="background-color: var(--button-primary-bg-color); color: var(--button-primary-text-color);">
                            {{ __('Order via WhatsApp') }}
                        </button>
                    @else
                        <p class="mt-6 text-sm text-red-600 text-center">{{ __('WhatsApp number is not configured for ordering.') }}</p>
                    @endif
                </div>
            </div>

        @else
            <div class="text-center py-24">
                @include('partials.cart-empty-svg')
                <h3 class="mt-4 text-2xl font-semibold" style="color: var(--text-color);">{{ __('Your Cart is Empty') }}</h3>
                <p class="mt-2 text-lg" style="color: var(--text-color); opacity: 0.7;">{{ __('Looks like you haven\'t added anything to your cart yet.') }}</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm transition-colors" style="background-color: var(--button-primary-bg-color); color: var(--button-primary-text-color);">
                        {{ __('Continue Shopping') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateCart(productId, newQuantity) {
            fetch(`/cart/update/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Satırdaki miktarı ve alt toplamı güncelle
                    const row = document.querySelector(`tr[data-product-id='${productId}']`);
                    if (row) {
                        row.querySelector('input[name="quantity"]').value = data.newQuantity;
                        row.querySelector('.subtotal-cell div').textContent = `₼${parseFloat(data.itemSubtotal).toFixed(2)}`;
                    }
                    // Toplamı güncelle
                    if (data.cartTotal) {
                        document.querySelectorAll('.cart-total-amount').forEach(el => {
                            el.textContent = `₼${parseFloat(data.cartTotal).toFixed(2)}`;
                        });
                    }
                    // Sepet sayacı güncelle
                    if (data.cartItemsCount !== undefined) {
                        const cartCountElements = [
                            document.getElementById('header-cart-count'),
                            document.getElementById('mobile-header-cart-count'),
                            document.getElementById('mobile-menu-cart-count')
                        ];
                        cartCountElements.forEach(el => {
                            if (el) {
                                el.textContent = data.cartItemsCount;
                                if (data.cartItemsCount > 0) {
                                    el.style.display = 'inline-flex';
                                } else {
                                    el.style.display = 'none';
                                }
                            }
                        });
                    }
                }
            });
        }

        document.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const input = this.parentElement.querySelector('input[name="quantity"]');
                let value = parseInt(input.value);
                if (this.classList.contains('plus')) {
                    value++;
                } else if (this.classList.contains('minus')) {
                    value = Math.max(1, value - 1);
                }
                input.value = value;
                updateCart(input.dataset.productId, value);
            });
        });

        document.querySelectorAll('input[name="quantity"]').forEach(input => {
            input.addEventListener('change', function () {
                let value = parseInt(this.value);
                if (isNaN(value) || value < 1) value = 1;
                this.value = value;
                updateCart(this.dataset.productId, value);
            });
        });

        // WhatsApp ile sipariş için dinamik link oluşturma
        const whatsappBtn = document.getElementById('whatsapp-order-btn');
        if (whatsappBtn) {
            whatsappBtn.addEventListener('click', function () {
                const whatsappNumber = @json(preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? ''));
                let message = `{{ __('Hello! I would like to order the following items:') }}\n\n`;
                let total = 0;
                document.querySelectorAll('tr[data-product-id]').forEach(row => {
                    const name = row.querySelector('.text-sm.font-medium').textContent.trim();
                    const quantity = row.querySelector('input[name="quantity"]').value;
                    const price = row.querySelectorAll('td')[1].textContent.replace(/[^\d.,]/g, '').replace(',', '.');
                    const subtotal = row.querySelector('.subtotal-cell div').textContent.replace(/[^\d.,]/g, '').replace(',', '.');
                    total += parseFloat(subtotal);
                    message += `*${name}*\n{{ __('Quantity:') }} ${quantity}\n{{ __('Price:') }} ₼${price}\n{{ __('Subtotal:') }} ₼${parseFloat(subtotal).toFixed(2)}\n\n`;
                });
                message += '---------------------\n';
                message += `*{{ __('Total Amount:') }}* ₼${total.toFixed(2)}`;
                const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            });
        }
    });
</script>
@endpush 