<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to MiniShop!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-blue-700 to-purple-800 rounded-2xl p-12 mb-12 text-white text-center shadow-2xl">
                <h1 class="text-5xl font-bold mb-6 text-white">🛍️ MiniShop</h1>
                <p class="text-xl text-white opacity-95">Discover amazing products at great prices!</p>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Featured Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 border border-gray-200">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                     class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400 text-2xl">📦</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $product->name }}</h3>
                                <p class="text-gray-700 mb-4">{{ Str::limit($product->description, 100) }}</p>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-green-700">${{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('shop.show', $product) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-2xl">
                    <p class="text-gray-700 text-xl mb-4">No products available yet.</p>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200">
                            Go to Admin Dashboard
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</x-app-layout>