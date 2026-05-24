<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices for the authenticated customer.
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $invoices = $customer->invoices()->latest()->get(); // Assuming a 'invoices' relationship on the Customer model
        return view('customer-portal.invoices.index', compact('invoices'));
    }
}