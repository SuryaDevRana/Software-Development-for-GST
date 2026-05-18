<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Add New Product</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Add a new product to your catalog</p>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto animate-fade-in">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
            <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
                @csrf

                <!-- Product Name Field -->
                <div>
                    <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4m0 0L4 7m16 0l-8 4m8-4v10l-8 4m0-10L4 7m0 10l8 4m0 0l8-4m-8 4v-10"></path>
                            </svg>
                            Product Name
                        </span>
                    </label>
                    <input type="text" name="name" placeholder="Enter product name" required
                           class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300"
                           value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Field -->
                <div>
                    <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Price (₹)
                        </span>
                    </label>
                    <input type="number" name="price" placeholder="Enter price" step="0.01" required
                           class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300"
                           value="{{ old('price') }}">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GST Rate Field -->
                <div>
                    <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            GST Rate (%)
                        </span>
                    </label>
                    <div class="flex space-x-3">
                        @foreach([5, 12, 18, 28] as $rate)
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="gst_rate" value="{{ $rate }}" {{ old('gst_rate') == $rate ? 'checked' : '' }} class="w-4 h-4 text-purple-600 focus:ring-purple-500">
                                <span class="ml-2 text-gray-700 dark:text-gray-300 font-medium">{{ $rate }}%</span>
                            </label>
                        @endforeach
                    </div>
                    <input type="number" name="gst_rate" placeholder="Or enter custom rate" step="0.1" 
                           class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300 mt-3"
                           value="{{ old('gst_rate') }}">
                    @error('gst_rate')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                    <a href="{{ route('products.index') }}" class="px-6 py-2 text-gray-700 dark:text-gray-300 border-2 border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:shadow-lg transition duration-300 transform hover:scale-105 font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>