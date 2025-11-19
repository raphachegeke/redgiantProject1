<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Add Product Button -->
                    <div class="mb-6">
                        <a href="{{ route('products.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Product
                        </a>
                    </div>

                    <!-- Products Table -->
                    @if ($products->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b">Name</th>
                                        <th class="py-2 px-4 border-b">Price</th>
                                        <th class="py-2 px-4 border-b">Available</th>
                                        <th class="py-2 px-4 border-b">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                                            <td class="py-2 px-4 border-b">${{ number_format($product->price, 2) }}</td>
                                            <td class="py-2 px-4 border-b">
                                                @if ($product->available)
                                                    <span class="text-green-600">Yes</span>
                                                @else
                                                    <span class="text-red-600">No</span>
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <a href="{{ route('products.edit', $product) }}" 
                                                   class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                                <form action="{{ route('products.destroy', $product) }}" 
                                                      method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No products found. <a href="{{ route('products.create') }}" class="text-blue-600">Create your first product!</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>