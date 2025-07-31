<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
public function index()
{
    // Ambil ID admin dari users table berdasarkan role
    $adminUser = User::where('role', 'admin')->first();

    // Ambil produk milik admin
    $products = Product::where('user_id', $adminUser->id)->get();

    return view('customer.dashboard', compact('products'));
}
}
