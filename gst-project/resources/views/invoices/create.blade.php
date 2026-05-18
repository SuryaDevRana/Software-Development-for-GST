<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Create New Invoice</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6" x-data="{ items: [{ id: '', qty: 1 }] }">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
            <form action="{{ route('invoice.store') }}" method="POST">
                @csrf
                
                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Select Customer</label>
                    <select name="customer_id" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">
                        <option value="">-- Choose Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->gstin }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Invoice Items</h3>
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-600 dark:text-gray-400 text-sm font-bold uppercase">
                                <th class="pb-2">Product</th>
                                <th class="pb-2 w-32">Qty</th>
                                <th class="pb-2 w-10"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, index) in items" :key="index">
                                <tr>
                                    <td class="py-2 pr-4">
                                        <select :name="'products['+index+'][id]'" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">
                                            <option value="">-- Select --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }} (₹{{ $product->price }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="py-2">
                                        <input type="number" :name="'products['+index+'][qty]'" x-model="item.qty" min="1" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">
                                    </td>
                                    <td class="py-2 text-right">
                                        <button type="button" @click="items.splice(index, 1)" class="text-red-500 hover:text-red-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <button type="button" @click="items.push({ id: '', qty: 1 })" class="mt-4 text-indigo-600 font-bold hover:underline">
                        + Add Another Item
                    </button>
                </div>

                <div class="mt-8 pt-6 border-t flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-2 rounded-lg font-bold shadow-md hover:bg-indigo-700">
                        Save Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>