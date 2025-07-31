<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
  public function index()
{
    $products = Product::with('user')->get();
    $mitras = User::where('role', 'mitra')->get();

    $adminUserIds = User::where('role', 'admin')->pluck('id');

    $productsAdmin = Product::with('user')
        ->whereIn('user_id', $adminUserIds)
        ->get();

    $productsMitra = Product::with('user')
        ->whereHas('user', function ($q) {
            $q->where('role', 'mitra');
        })->get();

    return view('admin_dashboard', compact('products', 'productsAdmin', 'productsMitra', 'mitras'));
}

public function storeMitra(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'mitra',
    ]);

    return back()->with('success', 'Akun mitra berhasil dibuat.');
}
}

