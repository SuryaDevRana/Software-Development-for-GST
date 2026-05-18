<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Invoice Details</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
            <div class="flex justify-between mb-8 border-b pb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $invoice->customer->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">GSTIN: {{ $invoice->customer->gstin }}</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-indigo-600 uppercase">#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-gray-500">{{ $invoice->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="mb-8">
                <h4 class="font-bold text-gray-700 dark:text-gray-300 mb-2">Billing Address:</h4>
                <p class="text-gray-600 dark:text-gray-400">{{ $invoice->customer->address }}</p>
                <p class="text-gray-600 dark:text-gray-400">Phone: {{ $invoice->customer->phone }}</p>
            </div>

            <div class="mt-8 border-t pt-6 text-right">
                <p class="text-gray-600 dark:text-gray-400 text-sm uppercase font-bold">Grand Total</p>
                <p class="text-4xl font-black text-gray-900 dark:text-white">₹{{ number_format($invoice->total, 2) }}</p>
            </div>

            <div class="mt-12 flex justify-between">
                <a href="{{ route('invoice.index') }}" class="text-gray-600 hover:underline">← Back to List</a>
                <button onclick="window.print()" class="bg-gray-100 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-200">
                    Print Invoice
                </button>
            </div>
        </div>
    </div>
</x-app-layout>