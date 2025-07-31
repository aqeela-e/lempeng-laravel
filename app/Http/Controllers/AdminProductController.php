<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable',
        'image' => 'nullable|image',
        'user_id' => 'nullable|exists:users,id'
    ]);
    $product = new Product($request->except('image', 'user_id'));

$product->user_id = $request->filled('user_id') ? $request->user_id : auth()->user()->id;

if ($request->hasFile('image')) {
    $path = $request->file('image')->store('products', 'public');
    $product->image = $path;
}

$product->save();

    return back()->with('success', 'Produk berhasil ditambahkan!');
}

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'wa' => 'nullable|string',
        'ig' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $product->fill($validated);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
    }

    $product->save();

    return back()->with([
        'success' => 'Produk berhasil disimpan',
        'from' => $product->user->role === 'admin' ? 'admin' : 'mitra'
    ]);
}

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
       if ($product->image) {
    Storage::disk('public')->delete($product->image);
    }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
