<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header Section with Back Button -->
            <div class="mb-8 flex justify-between items-center animate-slide-down">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Our Products</h1>
                    <p class="mt-2 text-sm text-gray-600">Discover our wide range of high-quality products</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            <!-- Filters and Sort Section -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6 animate-fade-in">
                <form action="{{ route('products.index') }}" method="GET" class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <select name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-300">
                            <option value="all">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="price_range" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-300">
                            <option value="">Price Range</option>
                            <option value="under_50" {{ request('price_range') == 'under_50' ? 'selected' : '' }}>Under $50</option>
                            <option value="50_to_100" {{ request('price_range') == '50_to_100' ? 'selected' : '' }}>$50 - $100</option>
                            <option value="100_to_200" {{ request('price_range') == '100_to_200' ? 'selected' : '' }}>$100 - $200</option>
                            <option value="over_200" {{ request('price_range') == 'over_200' ? 'selected' : '' }}>Over $200</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-4">
                        <select name="sort" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-300">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sort by: Newest First</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition duration-300 animate-scale-in group">
                    <a href="{{ route('products.show', $product) }}" class="block">
                        <div class="relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-500">
                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full animate-bounce-in">
                                    Only {{ $product->stock }} left
                                </div>
                            @elseif($product->stock == 0)
                                <div class="absolute top-2 right-2 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full animate-bounce-in">
                                    Out of Stock
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition duration-300">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                                <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 animate-fade-in">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 