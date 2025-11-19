<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                     class="w-full h-96 object-cover rounded-lg">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500 text-2xl">🛍️ No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                            <p class="text-2xl font-bold text-green-600 mb-4">${{ number_format($product->price, 2) }}</p>
                            
                            <div class="mb-6">
                                <p class="text-gray-700">{{ $product->description }}</p>
                            </div>

                            <!-- Add to Cart Form - ONLY FOR LOGGED IN USERS -->
                            @auth
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold w-full md:w-auto transition duration-200">
                                        🛒 Add to Cart
                                    </button>
                                </form>
                            @else
                                <!-- Show login prompt for guests -->
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                                    <div class="text-4xl mb-3">🔒</div>
                                    <h3 class="text-lg font-semibold text-yellow-800 mb-2">Login Required</h3>
                                    <p class="text-yellow-700 mb-4">You need to be logged in to add items to your cart.</p>
                                    <div class="flex space-x-4 justify-center">
                                        <a href="{{ route('login') }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-200">
                                            Login
                                        </a>
                                        <a href="{{ route('register') }}" 
                                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-200">
                                            Register
                                        </a>
                                    </div>
                                </div>
                            @endauth

                            <!-- Additional Info -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <p class="text-gray-600">
                                    <span class="font-semibold">Availability:</span> 
                                    @if($product->available)
                                        <span class="text-green-600">In Stock</span>
                                    @else
                                        <span class="text-red-600">Out of Stock</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>