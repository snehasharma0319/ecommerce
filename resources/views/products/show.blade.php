<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">
                <!-- Product Image -->
                <div class="aspect-w-4 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover object-center w-full h-full">
                </div>

                <!-- Product Info -->
                <div class="mt-8 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>
                    
                    <!-- Price -->
                    <div class="mt-4">
                        <p class="text-3xl text-gray-900">${{ number_format($product->price, 2) }}</p>
                    </div>

                    <!-- Stock Status -->
                    <div class="mt-4">
                        @if($product->stock > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                In Stock ({{ $product->stock }} available)
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900">Description</h3>
                        <div class="mt-2 prose prose-sm text-gray-500">
                            {{ $product->description }}
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900">Category</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                    </div>

                    <!-- Add to Cart Form -->
                    @if($product->stock > 0)
                        <div class="mt-8">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="flex items-center">
                                    <label for="quantity" class="mr-4 text-sm font-medium text-gray-700">Quantity</label>
                                    <div class="flex items-center border rounded-md">
                                        <button type="button" class="px-3 py-1 text-gray-600 hover:text-gray-700" onclick="decrementQuantity()">-</button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-0 focus:ring-0">
                                        <button type="button" class="px-3 py-1 text-gray-600 hover:text-gray-700" onclick="incrementQuantity()">+</button>
                                    </div>
                                </div>
                                <button type="submit" class="mt-6 w-full bg-indigo-600 py-3 px-8 rounded-md text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Reviews Section -->
                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h3 class="text-lg font-medium text-gray-900">Customer Reviews</h3>
                        @if($product->reviews->count() > 0)
                            <div class="mt-4 space-y-6">
                                @foreach($product->reviews as $review)
                                    <div class="border-b border-gray-200 pb-4">
                                        <div class="flex items-center mb-2">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="ml-2 text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-600">{{ $review->comment }}</p>
                                        <p class="mt-2 text-sm text-gray-500">By {{ $review->user->name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mt-4 text-gray-500">No reviews yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function decrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }

        function incrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            const maxValue = parseInt(input.getAttribute('max'));
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
            }
        }
    </script>
    @endpush
</x-app-layout> 