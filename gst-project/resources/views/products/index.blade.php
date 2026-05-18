<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Products</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage product catalog and pricing</p>
            </div>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Product
            </a>
        </div>
    </x-slot>

    <div class="animate-fade-in">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:scale-105 animate-slide-up border-l-4 border-purple-500">
                        <div class="bg-gradient-to-r from-purple-100 to-purple-50 dark:from-purple-900 dark:to-purple-800 p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-300">Price</p>
                                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">₹{{ number_format($product->price, 2) }}</p>
                                </div>
                                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-300">GST Rate</p>
                                    <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">{{ $product->gst_rate }}%</p>
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-xs font-semibold text-gray-600 dark:text-gray-300">Total with GST</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">₹{{ number_format($product->price + ($product->price * $product->gst_rate / 100), 2) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-200 dark:border-gray-600">
                            <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900 rounded transition duration-300">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 rounded transition duration-300">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4m0 0L4 7m16 0l-8 4m8-4v10l-8 4m0-10L4 7m0 10l8 4m0 0l8-4m-8 4v-10"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Products Yet</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Add your first product to get started</p>
                <a href="{{ route('products.create') }}" class="inline-block px-6 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition duration-300">
                    Add First Product
                </a>
            </div>
        @endif
    </div>
</x-app-layout>