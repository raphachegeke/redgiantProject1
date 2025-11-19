<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-500 text-white px-6 py-4 rounded-lg mb-6">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @auth
                @if(empty($cart))
                    <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
                        <div class="text-6xl mb-6">🛒</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Your cart is empty</h3>
                        <p class="text-gray-600 mb-8">Add some amazing products to get started!</p>
                        <a href="{{ route('shop.index') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold">
                            🏪 Continue Shopping
                        </a>
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl">
                        <div class="p-8">
                            <div class="flex justify-between items-center mb-8">
                                <h1 class="text-3xl font-bold text-gray-800">Your Shopping Cart</h1>
                                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                                    {{ count($cart) }} item(s)
                                </span>
                            </div>

                            <div class="overflow-x-auto rounded-xl border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Product</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Price</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Total</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php $total = 0 @endphp
                                        @foreach($cart as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                            <tr class="hover:bg-gray-50 transition duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        @if($details['image'])
                                                            <img class="h-16 w-16 object-cover rounded-lg shadow" src="{{ $details['image'] }}" alt="{{ $details['name'] }}">
                                                        @else
                                                            <div class="h-16 w-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center shadow">
                                                                <span class="text-gray-400 text-xl">📦</span>
                                                            </div>
                                                        @endif
                                                        <div class="ml-4">
                                                            <div class="text-lg font-semibold text-gray-900">{{ $details['name'] }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-700 font-semibold">
                                                    ${{ number_format($details['price'], 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                                        @csrf
                                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" 
                                                               class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                        <button type="submit" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-150">
                                                            Update
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-green-600">
                                                    ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="text-red-600 hover:text-red-800 font-semibold transition duration-150"
                                                                onclick="return confirm('Are you sure you want to remove this item?')">
                                                            🗑️ Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-right text-lg font-semibold text-gray-700">Total:</td>
                                            <td class="px-6 py-4 text-2xl font-bold text-green-600">${{ number_format($total, 2) }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                                <a href="{{ route('shop.index') }}" 
                                   class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-200 shadow hover:shadow-lg w-full sm:w-auto text-center">
                                    ← Continue Shopping
                                </a>
                                <button class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-200 shadow hover:shadow-lg w-full sm:w-auto text-center">
                                    🛍️ Proceed to Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- Show login prompt for guests -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-12 text-center">
                    <div class="text-6xl mb-6">🔒</div>
                    <h2 class="text-3xl font-bold text-yellow-800 mb-4">Authentication Required</h2>
                    <p class="text-yellow-700 text-lg mb-6">You need to be logged in to view and manage your shopping cart.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 justify-center">
                        <a href="{{ route('login') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition duration-200">
                            📝 Login to Your Account
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition duration-200">
                            🆕 Create New Account
                        </a>
                    </div>
                    <p class="text-yellow-600 mt-6">Don't have an account? Register now to start shopping!</p>
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>