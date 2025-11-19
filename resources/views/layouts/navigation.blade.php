<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-white shadow-lg border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Left Side - Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2 text-xl font-bold text-gray-800">
                        <span class="text-2xl">🛍️</span>
                        <span>MiniShop</span>
                    </a>
                </div>

                <!-- Right Side - ALWAYS VISIBLE -->
                <div class="flex items-center space-x-6">
                    <!-- Cart Link - FORCED VISIBLE -->
                    <a href="/cart" class="flex items-center space-x-1 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 font-medium">
                        <span class="text-lg">🛒</span>
                        <span>Cart</span>
                    </a>

                    <!-- User Info -->
                    @auth
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 font-medium">Hello, {{ Auth::user()->name }}</span>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200 font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
                            <a href="/login" class="text-gray-700 hover:text-blue-600 font-medium transition duration-200">
                                Login
                            </a>
                            <a href="/register" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200 font-medium">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Your page content -->
    @yield('content')
</body>
</html>