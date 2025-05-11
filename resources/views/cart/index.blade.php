@extends('layouts.app')

@section('title', __('Shopping Cart') . ' - ' . ($settings['site_name'] ?? __('Chaai')))

@section('content')
    <div class="container mx-auto px-4 py-16">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-10 font-serif">{{ __('Shopping Cart') }}</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">{{ __('Success!') }}</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">{{ __('Error!') }}</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @php $totalPrice = 0; @endphp

        @if(count($cart) > 0)
            <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Product') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Price') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Quantity') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Subtotal') }}</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cart as $id => $details)
                            @php $totalPrice += $details['price'] * $details['quantity']; @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16">
                                            @if($details['image_path'])
                                                <img class="h-16 w-16 rounded-md object-cover" src="{{ Storage::url($details['image_path']) }}" alt="{{ $details['name'] }}">
                                            @else
                                                <img class="h-16 w-16 rounded-md object-cover" src="https://via.placeholder.com/150?text={{ urlencode($details['name']) }}" alt="{{ $details['name'] }}">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $details['name'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">₼{{ number_format($details['price'], 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 text-center border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                        <button type="submit" class="ml-2 inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            {{ __('Update') }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">₼{{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="{{ __('Remove') }}">
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

            <div class="mt-8 flex justify-end">
                <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
                    <div class="flex justify-between text-lg font-semibold text-gray-800">
                        <span>{{ __('Total:') }}</span>
                        <span>₼{{ number_format($totalPrice, 2) }}</span>
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
                        <a href="{{ $whatsappUrl }}" target="_blank" class="block w-full text-center mt-6 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg text-md transition-colors">
                            {{ __('Order via WhatsApp') }}
                        </a>
                    @else
                        <p class="mt-6 text-sm text-red-600 text-center">{{ __('WhatsApp number is not configured for ordering.') }}</p>
                    @endif
                </div>
            </div>

        @else
            <div class="text-center py-16">
                @include('partials.cart-empty-svg')
                <h3 class="mt-4 text-2xl font-semibold text-gray-700">{{ __('Your Cart is Empty') }}</h3>
                <p class="mt-2 text-lg text-gray-500">{{ __('Looks like you haven\'t added anything to your cart yet.') }}</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        {{ __('Continue Shopping') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Gələcəkdə lazım olarsa, JavaScript kodları üçün yer
</script>
@endpush 