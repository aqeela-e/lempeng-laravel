<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MitraController extends Controller
{
 public function index()
{
    $products = Product::where('user_id', auth()->id())->get();
    return view('mitra_dashboard', compact('products'));
}



    // Tambahkan method lain kalau perlu, seperti:
    public function myProducts()
    {
        $products = auth()->user()->products;
        return view('mitra.products.index', compact('products'));
    }

    public function addStock(Request $request, $id)
{
    $request->validate([
        'stock' => 'required|integer|min:1',
    ]);

    $product = Product::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    if ($product->stock < $request->stock) {
        return back()->withErrors(['stock' => 'Jumlah pengurangan melebihi stok saat ini.']);
    }

    $product->stock -= $request->stock;
    $product->save();

    return back()->with('success', 'Stok berhasil dikurangi.');
}
}

