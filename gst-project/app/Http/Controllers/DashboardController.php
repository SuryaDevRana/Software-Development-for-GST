<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $invoiceCount = Invoice::count();
        $customerCount = Customer::count();
        $productCount = Product::count();
        $totalRevenue = Invoice::sum('total');
        $newCustomersThisWeek = Customer::where('created_at', '>=', now()->subDays(7))->count();
        $averageInvoice = Invoice::avg('total') ?? 0;
        $largestInvoice = Invoice::orderByDesc('total')->first();
        $recentInvoices = Invoice::with('customer')->orderByDesc('created_at')->take(5)->get();
        $topCustomers = Customer::withCount('invoices')->orderByDesc('invoices_count')->take(4)->get();

        // New: Monthly Revenue Chart Data
        $revenueData = Invoice::selectRaw('SUM(total) as amount, DATE_FORMAT(created_at, "%b") as month')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->get();

        return view('dashboard', compact(
            'invoiceCount',
            'customerCount',
            'productCount',
            'totalRevenue',
            'newCustomersThisWeek',
            'averageInvoice',
            'largestInvoice',
            'recentInvoices',
            'topCustomers',
            'revenueData'
        ));
    }
}
