<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('shop.index') }}" class="text-xl font-bold">🛍️ MiniShop</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('cart') }}" class="text-gray-700 hover:text-gray-900">
                    🛒 Cart
                    @if(session('cart'))
                        <span class="bg-red-500 text-white rounded-full px-2 py-1 text-xs">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>