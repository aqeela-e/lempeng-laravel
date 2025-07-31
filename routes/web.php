<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🌐 Halaman utama: redirect ke daftar produk (tanpa login)
Route::get('/', fn() => redirect('/products'));

// 🛍️ Produk untuk customer (tanpa login)
Route::get('/products', [CustomerController::class, 'index'])->name('customer.products');

// 🔐 Join page untuk login & register
Route::get('/join', fn() => view('auth.join'))
    ->middleware('guest')
    ->name('join');

// 🧑‍💼 ADMIN Routes (harus login dan role admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/mitra', [AdminController::class, 'storeMitra'])->name('admin.mitra.store')->middleware(['auth', 'role:admin']);

    Route::resource('/admin/products', AdminProductController::class)->names([
        'index'   => 'admin.products.index',
        'create'  => 'admin.products.create',
        'store'   => 'admin.products.store',
        'show'    => 'admin.products.show',
        'edit'    => 'admin.products.edit',
        'update'  => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
});

// 👨‍🌾 MITRA Routes (harus login dan role mitra)
Route::middleware(['auth', 'role:mitra'])->group(function () {
    Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.dashboard');
    Route::get('/mitra/products', [MitraController::class, 'myProducts'])->name('mitra.products');
    Route::post('/mitra/products/{id}/stock', [MitraController::class, 'addStock'])->name('mitra.products.stock');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/join');
    }

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'mitra' => redirect()->route('mitra.dashboard'),
        default => redirect()->route('customer.products'),
    };
})->middleware('auth')->name('dashboard');

// 👤 Profile routes (semua yang login bisa akses)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔒 Route auth bawaan Laravel Breeze/Fortify
require __DIR__ . '/auth.php';
