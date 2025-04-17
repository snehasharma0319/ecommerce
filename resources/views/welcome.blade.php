<x-app-layout>
    <div class="bg-white">
        <!-- Hero Section -->
        <div class="relative bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Welcome to</span>
                        <span class="block text-indigo-600">Our E-Commerce Store</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Discover amazing products at great prices. Shop with confidence and enjoy a seamless shopping experience.
                    </p>
                    <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                        <div class="rounded-md shadow">
                            <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Products Section -->
        <div class="bg-gray-50">
            <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Featured Products</h2>
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                    @foreach($featuredProducts as $product)
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 rounded-md overflow-hidden group-hover:opacity-75">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Only {{ $product->stock }} left
                                </div>
                            @elseif($product->stock == 0)
                                <div class="absolute top-2 right-2 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Out of Stock
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="{{ route('products.show', $product) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ Str::limit($product->description, 100) }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Shop by Category</h2>
                <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="group">
                        <div class="relative bg-white border rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <h3 class="text-base font-medium text-gray-900">{{ $category->name }}</h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $category->products_count }} products</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
