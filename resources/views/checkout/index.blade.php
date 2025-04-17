<x-app-layout>
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 pt-8 pb-16 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Checkout</h1>

                <form action="{{ route('orders.store') }}" method="POST" class="mt-8">
                    @csrf
                    <div class="mt-6">
                        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Shipping Information</h3>
                                    <p class="mt-1 text-sm text-gray-500">Enter your shipping address details.</p>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="shipping_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                            <input type="text" name="shipping_name" id="shipping_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>

                                        <div class="col-span-6">
                                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">Street Address</label>
                                            <input type="text" name="shipping_address" id="shipping_address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label for="shipping_city" class="block text-sm font-medium text-gray-700">City</label>
                                            <input type="text" name="shipping_city" id="shipping_city" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="shipping_state" class="block text-sm font-medium text-gray-700">State</label>
                                            <input type="text" name="shipping_state" id="shipping_state" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="shipping_zip" class="block text-sm font-medium text-gray-700">ZIP / Postal</label>
                                            <input type="text" name="shipping_zip" id="shipping_zip" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 mt-8">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Payment Information</h3>
                                    <p class="mt-1 text-sm text-gray-500">Enter your payment details.</p>
                                </div>
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                                            <input type="text" name="card_number" id="card_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="expiry" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                                            <input type="text" name="expiry" id="expiry" placeholder="MM/YY" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                                            <input type="text" name="cvv" id="cvv" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 mt-8">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Order Summary</h3>
                            <div class="flow-root">
                                <ul role="list" class="-my-6 divide-y divide-gray-200">
                                    @foreach($cartItems as $id => $item)
                                        <li class="py-6 flex">
                                            <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-center object-cover">
                                            </div>
                                            <div class="ml-4 flex-1 flex flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                                        <h3>{{ $item['name'] }}</h3>
                                                        <p class="ml-4">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-500">Qty {{ $item['quantity'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="border-t border-gray-200 mt-6 pt-6">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p>${{ number_format($total, 2) }}</p>
                                </div>
                                <div class="flex justify-between text-base font-medium text-gray-900 mt-2">
                                    <p>Shipping</p>
                                    <p>$10.00</p>
                                </div>
                                <div class="flex justify-between text-base font-medium text-gray-900 mt-2">
                                    <p>Tax (10%)</p>
                                    <p>${{ number_format($total * 0.1, 2) }}</p>
                                </div>
                                <div class="flex justify-between text-lg font-bold text-gray-900 mt-4">
                                    <p>Total</p>
                                    <p>${{ number_format($total + 10 + ($total * 0.1), 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <a href="{{ route('cart.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Back to Cart
                            </a>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Place Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 