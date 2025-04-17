<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Shopping Cart</h1>

            @if(count($cartItems) > 0)
                <div class="mt-8">
                    <div class="flow-root">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            @foreach($cartItems as $id => $item)
                                <li class="flex py-6">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover object-center">
                                    </div>

                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>{{ $item['name'] }}</h3>
                                                <p class="ml-4">${{ number_format($item['price'], 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <div class="flex items-center">
                                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                                    <label for="quantity" class="mr-2 text-gray-500">Qty</label>
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 rounded-md border-gray-300 text-sm">
                                                    <button type="submit" class="ml-2 text-indigo-600 hover:text-indigo-500">Update</button>
                                                </form>
                                            </div>

                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <button type="submit" class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Subtotal</p>
                            <p>${{ number_format($total, 2) }}</p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>

                        <div class="mt-6">
                            <a href="{{ route('checkout.index') }}" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                                Proceed to Checkout
                            </a>
                        </div>

                        <div class="mt-4">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">Clear Cart</button>
                            </form>
                        </div>

                        <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                            <p>
                                or
                                <a href="{{ route('products.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Continue Shopping
                                    <span aria-hidden="true"> &rarr;</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-8 text-center">
                    <p class="text-gray-500">Your cart is empty.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-500">
                            Continue Shopping
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 