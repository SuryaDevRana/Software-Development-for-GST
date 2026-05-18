<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InvoiceController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('invoices.create', compact('customers', 'products'));
    }


    public function index()
{
    $invoices = Invoice::with('customer')->get();
    return view('invoices.index', compact('invoices'));
}



    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $total = 0;
            $invoice = Invoice::create([
                'customer_id' => $request->customer_id,
                'total' => 0
            ]);

            foreach ($request->products as $item) {
                if (isset($item['id'])) {
                    $product = Product::find($item['id']);
                    $qty = $item['qty'];

                    $price = $product->price * $qty;
                    $gst = ($price * $product->gst_rate) / 100;

                    $total += $price + $gst;

                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $price
                    ]);
                }
            }

            $invoice->update(['total' => $total]);
            return redirect()->route('invoice.index')->with('success', 'Invoice created successfully.');
        });
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['customer']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.edit', compact('invoice', 'customers', 'products'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->only('customer_id', 'total'));
        return redirect()->route('invoice.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        // Delete associated items first to maintain integrity
        InvoiceItem::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();
        return redirect()->route('invoice.index')->with('success', 'Invoice deleted successfully.');
    }
}