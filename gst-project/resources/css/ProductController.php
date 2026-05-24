<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products for the customer portal.
     */
    public function index()
    {
        $products = Product::all(); // Or apply pagination, filtering, etc.
        return view('customer-portal.products.index', compact('products'));
    }
}