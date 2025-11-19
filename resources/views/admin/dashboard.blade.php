<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MiniShop Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome to MiniShop Admin!</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('products.index') }}" 
                           class="block p-6 bg-blue-100 rounded-lg hover:bg-blue-200 transition">
                            <h4 class="font-bold text-blue-800">Manage Products</h4>
                            <p class="text-blue-600">Add, edit, or delete products</p>
                        </a>
                        <a href="{{ url('/') }}" 
                           class="block p-6 bg-green-100 rounded-lg hover:bg-green-200 transition">
                            <h4 class="font-bold text-green-800">View Shop</h4>
                            <p class="text-green-600">See how customers view your products</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>